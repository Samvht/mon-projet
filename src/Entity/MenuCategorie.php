<?php

namespace App\Entity;

use App\Repository\MenuCategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuCategorieRepository::class)]
class MenuCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'menuCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Menu $menu = null;

    #[ORM\ManyToOne(inversedBy: 'menuCategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $cayegorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): static
    {
        $this->menu = $menu;

        return $this;
    }

    public function getCayegorie(): ?Categorie
    {
        return $this->cayegorie;
    }

    public function setCayegorie(?Categorie $cayegorie): static
    {
        $this->cayegorie = $cayegorie;

        return $this;
    }
}
