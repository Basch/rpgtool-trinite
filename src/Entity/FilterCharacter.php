<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilterCharacterRepository")
 */
class FilterCharacter extends ItemLink
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlayerCharacter", inversedBy="filters")
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campaign")
     * @ORM\JoinColumn(nullable=false)
     */
    private $campaign;

    public function __toString()
    {
        return 'filterAsset'.$this->getId();
    }

    public function getId()
    {
        return $this->id;
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

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): self
    {
        $this->campaign = $campaign;

        return $this;
    }
}
