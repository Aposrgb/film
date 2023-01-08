<?php

namespace App\Helper\DTO;

use OpenApi\Annotations as OA;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    /** @OA\Property(type="string") */
    #[Assert\NotBlank(groups: ['registration', 'authorization'])]
    #[Assert\Email(groups: ['registration', 'authorization'])]
    #[Assert\Length(min: 6, max: 30, groups: ['registration', 'authorization'])]
    #[Assert\Type(type: 'string', groups: ['registration', 'authorization'])]
    #[Groups(groups: ['registration', 'authorization'])]
    private $email;

    /** @OA\Property(type="string") */
    #[Assert\NotBlank(groups: ['registration', 'authorization'])]
    #[Assert\Length(min: 6, max: 30, groups: ['registration', 'authorization'])]
    #[Assert\Type(type: 'string', groups: ['registration', 'authorization'])]
    #[Groups(groups: ['registration', 'authorization'])]
    private $password;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return UserDTO
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return UserDTO
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}