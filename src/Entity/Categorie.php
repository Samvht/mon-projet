<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64, unique: true)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    /**
     * @var Collection<int, PlatCategorie>
     */
    #[ORM\OneToMany(targetEntity: PlatCategorie::class, mappedBy: 'categorie')]
    private Collection $platCategories;

    /**
     * @var Collection<int, MenuCategorie>
     */
    #[ORM\OneToMany(targetEntity: MenuCategorie::class, mappedBy: 'cayegorie')]
    private Collection $menuCategories;

    public function __construct()
    {
        $this->platCategories = new ArrayCollection();
        $this->menuCategories = new ArrayCollection();
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
            $platCategory->setCategorie($this);
        }

        return $this;
    }

    public function removePlatCategory(PlatCategorie $platCategory): static
    {
        if ($this->platCategories->removeElement($platCategory)) {
            // set the owning side to null (unless already changed)
            if ($platCategory->getCategorie() === $this) {
                $platCategory->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MenuCategorie>
     */
    public function getMenuCategories(): Collection
    {
        return $this->menuCategories;
    }

    public function addMenuCategory(MenuCategorie $menuCategory): static
    {
        if (!$this->menuCategories->contains($menuCategory)) {
            $this->menuCategories->add($menuCategory);
            $menuCategory->setCayegorie($this);
        }

        return $this;
    }

    public function removeMenuCategory(MenuCategorie $menuCategory): static
    {
        if ($this->menuCategories->removeElement($menuCategory)) {
            // set the owning side to null (unless already changed)
            if ($menuCategory->getCayegorie() === $this) {
                $menuCategory->setCayegorie(null);
            }
        }

        return $this;
    }
}
