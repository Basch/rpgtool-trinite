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
     * @ORM\OneToMany(targetEntity="PlayerCharacter", mappedBy="user", cascade={"persist"})
     */
    private $characters;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Campaign", mappedBy="Master")
     */
    private $MasteredCampaigns;

    public function __construct()
    {
        parent::__construct();
        $this->setName('');
        $this->addRole('ROLE_USER');
        $this->characters = new ArrayCollection();
        $this->MasteredCampaigns = new ArrayCollection();
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
            $characterSheet->setUser($this);
        }

        return $this;
    }

    public function removeCharacter( PlayerCharacter $characterSheet): self
    {
        if ($this->characters->contains($characterSheet)) {
            $this->characters->removeElement($characterSheet);
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
        $played_campaigns = new ArrayCollection();
        foreach( $this->getCharacters() as $character ) {
            $played_campaigns->add( $character->getCampaign() );
        }


        return $played_campaigns;
    }

}
