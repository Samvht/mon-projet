<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32, unique: true)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descritpion = null;

    #[ORM\Column]
    private array $heureOUvertureMatin = [];

    #[ORM\Column]
    private array $heureOuvertureSoir = [];

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $nbreMaxCouverts = null;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'restaurant', orphanRemoval: true)]
    private Collection $reservations;

    #[ORM\OneToOne(inversedBy: 'restaurant', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $proprietaire = null;

    /**
     * @var Collection<int, Photo>
     */
    #[ORM\OneToMany(targetEntity: Photo::class, mappedBy: 'restaurant', orphanRemoval: true)]
    private Collection $photos;

    /**
     * @var Collection<int, Menu>
     */
    #[ORM\OneToMany(targetEntity: Menu::class, mappedBy: 'restaurant', orphanRemoval: true)]
    private Collection $menus;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescritpion(): ?string
    {
        return $this->descritpion;
    }

    public function setDescritpion(?string $descritpion): static
    {
        $this->descritpion = $descritpion;

        return $this;
    }

    public function getHeureOUvertureMatin(): array
    {
        return $this->heureOUvertureMatin;
    }

    public function setHeureOUvertureMatin(array $heureOUvertureMatin): static
    {
        $this->heureOUvertureMatin = $heureOUvertureMatin;

        return $this;
    }

    public function getHeureOuvertureSoir(): array
    {
        return $this->heureOuvertureSoir;
    }

    public function setHeureOuvertureSoir(array $heureOuvertureSoir): static
    {
        $this->heureOuvertureSoir = $heureOuvertureSoir;

        return $this;
    }

    public function getNbreMaxCouverts(): ?int
    {
        return $this->nbreMaxCouverts;
    }

    public function setNbreMaxCouverts(int $nbreMaxCouverts): static
    {
        $this->nbreMaxCouverts = $nbreMaxCouverts;

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

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setRestaurant($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getRestaurant() === $this) {
                $reservation->setRestaurant(null);
            }
        }

        return $this;
    }

    public function getProprietaire(): ?User
    {
        return $this->proprietaire;
    }

    public function setProprietaire(User $proprietaire): static
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): static
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setRestaurant($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getRestaurant() === $this) {
                $photo->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): static
    {
        if (!$this->menus->contains($menu)) {
            $this->menus->add($menu);
            $menu->setRestaurant($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): static
    {
        if ($this->menus->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getRestaurant() === $this) {
                $menu->setRestaurant(null);
            }
        }

        return $this;
    }
}
