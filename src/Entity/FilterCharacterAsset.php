<?php

namespace App\Entity;

use App\Model\FilterCharacterInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilterCharacterAssetRepository")
 */
class FilterCharacterAsset implements FilterCharacterInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Asset", inversedBy="FilterCharacter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $asset;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlayerCharacter", inversedBy="filterAssets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playerCharacter;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="boolean")
     */
    private $owned;

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

    public function getPlayerCharacter(): ?PlayerCharacter
    {
        return $this->playerCharacter;
    }

    public function setPlayerCharacter(?PlayerCharacter $playerCharacter): self
    {
        $this->playerCharacter = $playerCharacter;

        return $this;
    }

    public function getCharacter(): ?PlayerCharacter
    {
        return $this->playerCharacter;
    }

    public function setCharacter(?PlayerCharacter $playerCharacter): self
    {
        $this->playerCharacter = $playerCharacter;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getOwned(): ?bool
    {
        return $this->owned;
    }

    public function setOwned(bool $owned): self
    {
        $this->owned = $owned;

        return $this;
    }
}
