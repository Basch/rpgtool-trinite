<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterSheet", mappedBy="user", cascade={"persist"})
     */
    private $characterSheets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Campaign", mappedBy="Master")
     */
    private $MasteredCampaigns;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Campaign", mappedBy="Players")
     */
    private $PlayedCampaigns;

    public function __construct()
    {
        parent::__construct();
        $this->setName('');
        $this->addRole('ROLE_USER');
        $this->characterSheets = new ArrayCollection();
        $this->MasteredCampaigns = new ArrayCollection();
        $this->PlayedCampaigns = new ArrayCollection();
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
            $characterSheet->setUser($this);
        }

        return $this;
    }

    public function removeCharacterSheet(CharacterSheet $characterSheet): self
    {
        if ($this->characterSheets->contains($characterSheet)) {
            $this->characterSheets->removeElement($characterSheet);
            // set the owning side to null (unless already changed)
            if ($characterSheet->getUser() === $this) {
                $characterSheet->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Campaign[]
     */
    public function getMasteredCampaigns(): Collection
    {
        return $this->MasteredCampaigns;
    }

    public function addMasteredCampaign(Campaign $masteredCampaign): self
    {
        if (!$this->MasteredCampaigns->contains($masteredCampaign)) {
            $this->MasteredCampaigns[] = $masteredCampaign;
            $masteredCampaign->setMaster($this);
        }

        return $this;
    }

    public function removeMasteredCampaign(Campaign $masteredCampaign): self
    {
        if ($this->MasteredCampaigns->contains($masteredCampaign)) {
            $this->MasteredCampaigns->removeElement($masteredCampaign);
            // set the owning side to null (unless already changed)
            if ($masteredCampaign->getMaster() === $this) {
                $masteredCampaign->setMaster(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Campaign[]
     */
    public function getPlayedCampaigns(): Collection
    {
        return $this->PlayedCampaigns;
    }

    public function addPlayedCampaign(Campaign $playedCampaign): self
    {
        if (!$this->PlayedCampaigns->contains($playedCampaign)) {
            $this->PlayedCampaigns[] = $playedCampaign;
            $playedCampaign->addPlayer($this);
        }

        return $this;
    }

    public function removePlayedCampaign(Campaign $playedCampaign): self
    {
        if ($this->PlayedCampaigns->contains($playedCampaign)) {
            $this->PlayedCampaigns->removeElement($playedCampaign);
            $playedCampaign->removePlayer($this);
        }

        return $this;
    }

}
