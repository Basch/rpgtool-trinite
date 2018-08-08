<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssetFilterRepository")
 */
class AssetFilter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Asset", inversedBy="assetFilters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $asset;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlayerCharacter", inversedBy="assetFilters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $character;


    public function __toString()
    {
        return $this->getCharacter()->getName().' - '.$this->getAsset()->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAsset(): ?Asset
    {
        return $this->asset;
    }

    public function setAsset(?Asset $asset): self
    {
        $this->asset = $asset;

        return $this;
    }

    public function getCharacter(): ?PlayerCharacter
    {
        return $this->character;
    }

    public function setCharacter(?PlayerCharacter $playerCharacter): self
    {
        $this->character = $playerCharacter;

        return $this;
    }


   
}
