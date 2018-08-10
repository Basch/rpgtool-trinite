<?php

namespace App\Entity;

use App\Model\FilterCharacterInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilterCharacterAuraRepository")
 */
class FilterCharacterAura implements FilterCharacterInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aura", inversedBy="FilterCharacter")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aura;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlayerCharacter", inversedBy="filterAuras")
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

    public function __toString()
    {
        return 'filterAura'.$this->getId();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAura(): ?Aura
    {
        return $this->aura;
    }

    public function setAura( ?Aura $aura): self
    {
        $this->aura = $aura;

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
