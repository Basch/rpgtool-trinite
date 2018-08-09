<?php

namespace App\Entity;

use App\Model\FiltrableItemCharacterInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssetRepository")
 */
class Asset implements FiltrableItemCharacterInterface
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
     * @ORM\OneToMany(targetEntity="FilterCharacterAsset", mappedBy="asset", orphanRemoval=true)
     */
    private $FilterCharacter;


    public function __construct()
    {
        $this->FilterCharacter = new ArrayCollection();
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
     * @return Collection|FilterCharacterAsset[]
     */
    public function getFilterCharacter(): Collection
    {
        return $this->FilterCharacter;
    }

    public function addFilterCharacter( FilterCharacterAsset $filterCharacter): self
    {
        if (!$this->FilterCharacter->contains($filterCharacter)) {
            $this->FilterCharacter[] = $filterCharacter;
            $filterCharacter->setAsset($this);
        }

        return $this;
    }

    public function removeFilterCharacter( FilterCharacterAsset $filterCharacter): self
    {
        if ($this->FilterCharacter->contains($filterCharacter)) {
            $this->FilterCharacter->removeElement($filterCharacter);
            // set the owning side to null (unless already changed)
            if ($filterCharacter->getAsset() === $this) {
                $filterCharacter->setAsset(null);
            }
        }

        return $this;
    }


}
