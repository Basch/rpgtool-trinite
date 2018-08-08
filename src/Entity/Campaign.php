<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CampaignRepository")
 */
class Campaign
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="MasteredCampaigns")
     */
    private $Master;

    /**
     * @ORM\OneToMany(targetEntity="PlayerCharacter", mappedBy="campaign", orphanRemoval=true)
     */
    private $characters;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AssetFilter", mappedBy="campaign", orphanRemoval=true)
     */
    private $assetFilters;

    public function __construct()
    {
        $this->Players = new ArrayCollection();
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

    public function getMaster(): ?User
    {
        return $this->Master;
    }

    public function setMaster(?User $Master): self
    {
        $this->Master = $Master;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getPlayers(): Collection
    {
        return new ArrayCollection(); // TODO: Configurer l'accesseur
    }

    /**
     * @return Collection|PlayerCharacter[]
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter( PlayerCharacter $characterSheet): self
    {
        if (!$this->characters->contains($characterSheet)) {
            $this->characters[] = $characterSheet;
            $characterSheet->setCampaign($this);
        }

        return $this;
    }

    public function removeCharacter( PlayerCharacter $characterSheet): self
    {
        if ($this->characters->contains($characterSheet)) {
            $this->characters->removeElement($characterSheet);
            // set the owning side to null (unless already changed)
            if ($characterSheet->getCampaign() === $this) {
                $characterSheet->setCampaign(null);
            }
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
            $assetFilter->setCampaign($this);
        }

        return $this;
    }

    public function removeAssetFilter(AssetFilter $assetFilter): self
    {
        if ($this->assetFilters->contains($assetFilter)) {
            $this->assetFilters->removeElement($assetFilter);
            // set the owning side to null (unless already changed)
            if ($assetFilter->getCampaign() === $this) {
                $assetFilter->setCampaign(null);
            }
        }

        return $this;
    }
}
