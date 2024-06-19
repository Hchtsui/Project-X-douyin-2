<?php

// src/Entity/Categories.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Videos::class, inversedBy: 'categories')]
    private Collection $categorieShorts;

    public function __construct()
    {
        $this->categorieShorts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection<int, Videos>
     */
    public function getCategorieShorts(): Collection
    {
        return $this->categorieShorts;
    }

    public function addCategorieShorts(Videos $categorieShorts): static
    {
        if (!$this->categorieShorts->contains($categorieShorts)) {
            $this->categorieShorts->add($categorieShorts);
        }

        return $this;
    }

    public function removeCategorieShorts(Videos $categorieShorts): static
    {
        $this->categorieShorts->removeElement($categorieShorts);
        return $this;
    }
}



