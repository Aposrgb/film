<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['get_profile'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['get_profile'])]
    private ?string $surname = null;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['get_profile'])]
    private ?\DateTimeInterface $dateRegistration;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['get_profile'])]
    private ?string $firstname = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['get_profile'])]
    private ?string $email = null;

    #[ORM\Column(type: 'simple_array')]
    private array $roles = ['ROLE_USER'];

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $password;

    #[ORM\Column]
    private ?int $subscription = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $subscriptionEnd = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $login = null;

    #[ORM\ManyToMany(targetEntity: Film::class, inversedBy: 'users')]
    private Collection $purchasedFilms;

    public function __construct()
    {
        $this->subscription = \SubscriptionAccessType::NO_SUBSCRIPTION->value;
        $this->dateRegistration = new \DateTime();
        $this->purchasedFilms = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return User
     */
    public function setId(?int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     * @return User
     */
    public function setSurname(?string $surname): User
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * @return User
     */
    public function setFirstname(?string $firstname): User
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return User
     */
    public function setEmail(?string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return User
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return User
     */
    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials()
    {

    }

    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateRegistration(): ?\DateTimeInterface
    {
        return $this->dateRegistration;
    }

    /**
     * @param \DateTimeInterface|null $dateRegistration
     * @return User
     */
    public function setDateRegistration(?\DateTimeInterface $dateRegistration): User
    {
        $this->dateRegistration = $dateRegistration;
        return $this;
    }

    public function getSubscription(): ?int
    {
        return $this->subscription;
    }

    public function setSubscription(int $subscription): self
    {
        $this->subscription = $subscription;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getPurchasedFilms(): Collection
    {
        return $this->purchasedFilms;
    }

    public function addPurchasedFilm(Film $purchasedFilm): self
    {
        if (!$this->purchasedFilms->contains($purchasedFilm)) {
            $this->purchasedFilms->add($purchasedFilm);
        }

        return $this;
    }

    public function removePurchasedFilm(Film $purchasedFilm): self
    {
        $this->purchasedFilms->removeElement($purchasedFilm);

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getSubscriptionEnd(): ?\DateTimeInterface
    {
        return $this->subscriptionEnd;
    }

    /**
     * @param \DateTimeInterface|null $subscriptionEnd
     * @return User
     */
    public function setSubscriptionEnd(?\DateTimeInterface $subscriptionEnd): User
    {
        $this->subscriptionEnd = $subscriptionEnd;
        return $this;
    }
}
