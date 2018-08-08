<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssetRepository")
 */
class Asset
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FireBlade", inversedBy="assets")
     */
    private $fireBlade;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PlayerCharacter", mappedBy="assets")
     */
    private $characters;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AssetFilter", mappedBy="asset", orphanRemoval=true)
     */
    private $assetFilters;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->assetFilters = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug( string $slug ): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFireBlade(): ?FireBlade
    {
        return $this->fireBlade;
    }

    public function setFireBlade(?FireBlade $fireBlade): self
    {
        $this->fireBlade = $fireBlade;

        return $this;
    }

    /**
     * @return Collection|PlayerCharacter[]
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(PlayerCharacter $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
            $character->addAsset($this);
        }

        return $this;
    }

    public function removeCharacter(PlayerCharacter $character): self
    {
        if ($this->characters->contains($character)) {
            $this->characters->removeElement($character);
            $character->removeAsset($this);
        }

        return $this;
    }

    /**
     * @return Collection|AssetFilter[]
     */
    public function getAssetFilters(): Collection
    {
        return $this->assetFilters;
    }

    public function addAssetFilter(AssetFilter $assetFilter): self
    {
        if (!$this->assetFilters->contains($assetFilter)) {
            $this->assetFilters[] = $assetFilter;
            $assetFilter->setAsset($this);
        }

        return $this;
    }

    public function removeAssetFilter(AssetFilter $assetFilter): self
    {
        if ($this->assetFilters->contains($assetFilter)) {
            $this->assetFilters->removeElement($assetFilter);
            // set the owning side to null (unless already changed)
            if ($assetFilter->getAsset() === $this) {
                $assetFilter->setAsset(null);
            }
        }

        return $this;
    }

}
