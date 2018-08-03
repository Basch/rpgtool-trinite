<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="MasteredCampaigns")
     */
    private $Master;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="PlayedCampaigns")
     */
    private $Players;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterSheet", mappedBy="campaign", orphanRemoval=true)
     */
    private $characterSheets;

    public function __construct()
    {
        $this->Players = new ArrayCollection();
        $this->characterSheets = new ArrayCollection();
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
        return $this->Players;
    }

    public function addPlayer(User $player): self
    {
        if (!$this->Players->contains($player)) {
            $this->Players[] = $player;
        }

        return $this;
    }

    public function removePlayer(User $player): self
    {
        if ($this->Players->contains($player)) {
            $this->Players->removeElement($player);
        }

        return $this;
    }

    /**
     * @return Collection|CharacterSheet[]
     */
    public function getCharacterSheets(): Collection
    {
        return $this->characterSheets;
    }

    public function addCharacterSheet(CharacterSheet $characterSheet): self
    {
        if (!$this->characterSheets->contains($characterSheet)) {
            $this->characterSheets[] = $characterSheet;
            $characterSheet->setCampaign($this);
        }

        return $this;
    }

    public function removeCharacterSheet(CharacterSheet $characterSheet): self
    {
        if ($this->characterSheets->contains($characterSheet)) {
            $this->characterSheets->removeElement($characterSheet);
            // set the owning side to null (unless already changed)
            if ($characterSheet->getCampaign() === $this) {
                $characterSheet->setCampaign(null);
            }
        }

        return $this;
    }
}
