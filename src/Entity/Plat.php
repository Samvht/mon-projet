<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64, unique: true)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    /**
     * @var Collection<int, PlatCategorie>
     */
    #[ORM\OneToMany(targetEntity: PlatCategorie::class, mappedBy: 'Plat')]
    private Collection $platCategories;

    public function __construct()
    {
        $this->platCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

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
     * @return Collection<int, PlatCategorie>
     */
    public function getPlatCategories(): Collection
    {
        return $this->platCategories;
    }

    public function addPlatCategory(PlatCategorie $platCategory): static
    {
        if (!$this->platCategories->contains($platCategory)) {
            $this->platCategories->add($platCategory);
            $platCategory->setPlat($this);
        }

        return $this;
    }

    public function removePlatCategory(PlatCategorie $platCategory): static
    {
        if ($this->platCategories->removeElement($platCategory)) {
            // set the owning side to null (unless already changed)
            if ($platCategory->getPlat() === $this) {
                $platCategory->setPlat(null);
            }
        }

        return $this;
    }
}
