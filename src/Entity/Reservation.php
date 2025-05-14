<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $nbreConvive = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateReservation = null;

    #[ORM\Column]
    private ?\DateTime $heureReservation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $allergies = null;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?restaurant $restaurant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbreConvive(): ?int
    {
        return $this->nbreConvive;
    }

    public function setNbreConvive(int $nbreConvive): static
    {
        $this->nbreConvive = $nbreConvive;

        return $this;
    }

    public function getDateReservation(): ?\DateTime
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTime $dateReservation): static
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getHeureReservation(): ?\DateTime
    {
        return $this->heureReservation;
    }

    public function setHeureReservation(\DateTime $heureReservation): static
    {
        $this->heureReservation = $heureReservation;

        return $this;
    }

    public function getAllergies(): ?string
    {
        return $this->allergies;
    }

    public function setAllergies(?string $allergies): static
    {
        $this->allergies = $allergies;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTime $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getRestaurant(): ?restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?restaurant $restaurant): static
    {
        $this->restaurant = $restaurant;

        return $this;
    }
}
