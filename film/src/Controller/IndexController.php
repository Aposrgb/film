<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\User;
use App\Helper\Exception\ApiException;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('index.twig');
    }

    #[Route('', name: 'empty_index', methods: ['GET'])]
    public function emptyIndex(): Response
    {
        return $this->redirectToRoute('index');
    }

    #[Route('/compilations', name: 'compilations', methods: ['GET'])]
    public function compilations(): Response
    {
        return $this->render('compilations.twig');
    }

    #[Route('/favorites', name: 'favorites', methods: ['GET'])]
    public function favorites(): Response
    {
        return $this->render('favorites.twig');
    }

    #[Route('/film', name: 'film', methods: ['GET'])]
    public function film(Request $request, FilmRepository $filmRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $context = [];
        $id = $request->query->get('id');
        if ($id) {
            $context['film'] = $filmRepository->find($id);
            $context['img'] = \FilmType::getImg($id);
            $context['k'] = \FilmType::getRatingK($id);
            $context['i'] = \FilmType::getRatingI($id);
            $context['desc'] = \FilmType::getDescription($id);
            $context['janr'] = htmlspecialchars_decode(\FilmType::getJanr($id));
            $context['rej'] = \FilmType::getRejisser($id);
            $context['actor'] = \FilmType::getActors($id);
            $context['trailer'] = \FilmType::getTrailers($id);
        }
        if ($user && $id) {
            $context['filmBuyed'] = $user->getPurchasedFilms()->contains($context['film']);
        }
        return $this->render('film.twig', parameters: $context);
    }

    #[Route('/films', name: 'films', methods: ['GET'])]
    public function films(): Response
    {
        return $this->render('films.twig');
    }

    #[Route('/new', name: 'new', methods: ['GET'])]
    public function new(): Response
    {
        return $this->render('new.twig');
    }

    #[Route('/settings', name: 'settings', methods: ['GET'])]
    public function settings(): Response
    {
        return $this->render('settings.twig');
    }

    #[Route('/search', name: 'search', methods: ['GET'])]
    public function search(): Response
    {
        return $this->render('search.twig');
    }

    #[Route('/subscriptions', name: 'subscriptions', methods: ['GET'])]
    public function subscriptions(): Response
    {
        return $this->render('subscriptions.twig');
    }

    #[Route('/reset/pass', name: 'reset_pass', methods: ['POST'])]
    public function resetPass(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            throw new ApiException(message: 'Не авторизован', status: Response::HTTP_FORBIDDEN);
        }
        $data = json_decode($request->getContent(), true) ?? [];
        if (!key_exists('password', $data)) {
            throw new ApiException(message: 'Нет данных');
        }
        if (!key_exists('old', $data)) {
            throw new ApiException(message: 'Нет данных');
        }
        if (!$hasher->isPasswordValid($user, $data['old'])) {
            throw new ApiException(message: 'Неверный пароль');
        }
        $user->setPassword($hasher->hashPassword($user, $data['password']));
        $entityManager->flush();
        return $this->json([]);
    }

    #[Route('/delete/profile/{user}', name: 'delete_profile', methods: ['DELETE'])]
    public function deleteProfile(User $user, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->json([]);
    }

    #[Route('/buy/film/{film}', name: 'buy_film', methods: ['POST'])]
    public function buyFilm(Film $film, EntityManagerInterface $entityManager): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        $user->addPurchasedFilm($film);
        $entityManager->flush();
        return $this->json([]);
    }

    #[Route('/buy/subs', name: 'buy_subscription', methods: ['POST'])]
    public function buySubscription(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            throw new ApiException(message: 'Не авторизован', status: Response::HTTP_FORBIDDEN);
        }
        $data = json_decode($request->getContent(), true) ?? [];
        if (!key_exists('type', $data)) {
            throw new ApiException(message: 'Нет типа покупки');
        }
        if (!key_exists('isPremium', $data) && !is_bool($data['isPremium'])) {
            throw new ApiException(message: 'Нет типа покупки подписки');
        }
        if (!key_exists('isProdlit', $data) && !is_bool($data['isProdlit'])) {
            throw new ApiException(message: '');
        }
        $isProdlit = $data['isProdlit'];
        $type = $data['isPremium'] ? \SubscriptionAccessType::VIP_SUBSCRIPTION->value : \SubscriptionAccessType::BASE_SUBSCRIPTION->value;
        $user->setSubscription($type);
        if ($data["type"] == \BuySubscriptionType::ONE_MONTH->value) {
            if ($user->getSubscriptionEnd() and $isProdlit) {
                $date = clone $user->getSubscriptionEnd();
                $user->setSubscriptionEnd($date->modify('+1 month'));
            } else {
                $user->setSubscriptionEnd((new \DateTime())->modify('+1 month'));
            }
        } else if ($data["type"] == \BuySubscriptionType::THREE_MONTH->value) {
            if ($user->getSubscriptionEnd() and $isProdlit) {
                $date = clone $user->getSubscriptionEnd();
                $user->setSubscriptionEnd($date->modify('+3 month'));;
            } else {
                $user->setSubscriptionEnd((new \DateTime())->modify('+3 month'));
            }
        } else if ($data["type"] == \BuySubscriptionType::SIX_MONTH->value) {
            if ($user->getSubscriptionEnd() and $isProdlit) {
                $date = clone $user->getSubscriptionEnd();
                $user->setSubscriptionEnd($date->modify('+6 month'));
            } else {
                $user->setSubscriptionEnd((new \DateTime())->modify('+6 month'));
            }
        }
        $entityManager->flush();
        return $this->json([]);
    }
}