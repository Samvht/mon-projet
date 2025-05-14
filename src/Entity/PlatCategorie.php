<?php

namespace App\Entity;

use App\Repository\PlatCategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatCategorieRepository::class)]
class PlatCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'platCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Plat $Plat = null;

    #[ORM\ManyToOne(inversedBy: 'platCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlat(): ?Plat
    {
        return $this->Plat;
    }

    public function setPlat(?Plat $Plat): static
    {
        $this->Plat = $Plat;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
