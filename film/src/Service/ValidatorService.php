<?php

namespace App\Service;

use App\Helper\EnumRoles\UserRoles;
use App\Helper\Exception\ApiException;
use App\Helper\Mapped\Helper;
use DateTime;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidatorService
{
    public function __construct(private readonly ValidatorInterface $validator)
    {
    }

    public function validate($body = [], $groupsBody = [], $constraints = []): void
    {
        $validationError = [];
        $groupsBody[] = 'pagination';
        $bodyError = $this->validator->validate($body, constraints: $constraints, groups: $groupsBody);
        $invalid_field = [];
        /** @var ConstraintViolation $error */
        foreach ($bodyError as $error) {
            $invalid_field[] = [
                'name' => $error->getPropertyPath(),
                'message' => $error->getMessage()
            ];
        }
        $validationError['body'] = $invalid_field;

        if (count($bodyError) > 0)
            throw new ApiException(message: 'Ошибки при выполнении запроса', validationError: $validationError, status: Response::HTTP_BAD_REQUEST);
    }

    public function checkRequestValidationNotNull($field, $fieldName = null): void
    {
        if ($field === null) {
            throw new ApiException(
                message: 'Пустой параметр: ' . $fieldName,
                detail: 'Missing required body',
                status: Response::HTTP_BAD_REQUEST);
        }
    }

    /** @param UploadedFile[] $files */
    public function validateImagesExtension(array $files, array $extensions): void
    {
        foreach ($files as $file) {
            if ($file) {
                var_export($file->getMimeType());
                if (!in_array($file->getMimeType(), $extensions)) {
                    throw new ApiException(
                        message: 'Не поддерживаемый формат файла (поддерживается '
                        . join(',', $extensions) .
                        ')',
                    );
                }
            }
        }
    }

    public function validateYear($object): void
    {
        try {
            if ($object) {
                new DateTime($object . '-01-01');
            }
        } catch (\Exception) {
            throw new ApiException(message: 'Невалидный год');
        }
    }

    public static function validateYearContext($object, ExecutionContextInterface $context): void
    {
        try {
            if ($object) {
                new DateTime($object . '-01-01');
            }
        } catch (\Exception) {
            throw new ApiException(message: 'Невалидный год');
        }
    }

    public function validateMaxRangeInteger($object): void
    {
        if (!is_numeric($object)) {
            throw new ApiException(message: 'Значение `' . $object . '` не является допустимым int');
        }
        if ($object > Helper::MAX_SIZE_INTEGER) {
            throw new ApiException(message: $object . ' is out of range for type integer');
        }
    }

    public static function validateDateWithoutContext($object): ?DateTime
    {
        try {
            if ($object) {
                return new DateTime($object);
            }
        } catch (\Exception) {
        }
        return null;
    }

    public static function validateDate($object, ExecutionContextInterface $context): void
    {
        try {
            $date = new DateTime($object);
        } catch (\Exception $e) {
            $context->buildViolation('Значение ' . $object . ' не является допустимой датой (верный формат: ГГГГ-ММ-ДД)')->addViolation();
        }
    }

    public static function validateArrayInteger($object, ExecutionContextInterface $context): void
    {
        if ($object) {
            $array = explode(',', $object);
            foreach ($array as $item) {
                if (!is_numeric($item)) {
                    $context->buildViolation('Значение ' . $object . ' не является допустимой массивом целых чисел (верный формат: 1,2,3,4 )')->addViolation();
                    break;
                }
            }
        }

    }

    public static function validateBoolean($object, ExecutionContextInterface $context): void
    {
        if (!$object || $object == "") {
            return;
        }
        if (is_numeric($object)) {
            $context->buildViolation('Значение `' . $object . '` не является допустимым boolean')->addViolation();
        } else {
            if ($object != 'false' and $object != 'true') {
                $context->buildViolation('Значение `' . $object . '` не является допустимым boolean')->addViolation();
            }
        }
    }

    public static function validateMaxRangeIntegerWithContext(int $object, ExecutionContextInterface $context): void
    {
        if ($object > Helper::MAX_SIZE_INTEGER) {
            $context->buildViolation(message: $object . ' is out of range for type integer')->addViolation();
        }
    }

    public static function validateInteger($object, ExecutionContextInterface $context): void
    {
        if (!is_numeric($object) && $object != "") {
            $context->buildViolation('Значение `' . $object . '` не является допустимым int')->addViolation();
        } else {
            self::validateMaxRangeIntegerWithContext((int)$object, $context);
        }
    }

    public function validateUsersRoles($object): bool
    {
        $roles = UserRoles::getRoles();
        foreach ($object as $role) {
            if (!in_array($role, $roles)) {
                return false;
            }
        }
        return true;
    }

    public static function validateUserRoles($object, ExecutionContextInterface $context): void
    {
        $roles = UserRoles::getRoles();
        foreach ($object as $role) {
            if (!in_array($role, $roles)) {
                $context->buildViolation('Значение "' . $role . '" не является допустимой ролью')->addViolation();
                return;
            }
        }
    }
}