<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerCharacterRepository")
 */
class PlayerCharacter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterZodiac", mappedBy="character", orphanRemoval=true)
     */
    private $characterZodiacs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="characters", cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterSkill", mappedBy="character", orphanRemoval=true)
     */
    private $characterSkills;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campaign", inversedBy="characters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $campaign;

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
     * @ORM\OneToMany(targetEntity="FilterCharacter", mappedBy="playerCharacter", orphanRemoval=true)
     */
    private $filters;

    public function __construct()
    {
        $this->characterZodiacs = new ArrayCollection();
        $this->characterSkills = new ArrayCollection();
        $this->filters = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|CharacterZodiac[]
     */
    public function getCharacterZodiacs(): Collection
    {
        return $this->characterZodiacs;
    }

    public function addCharacterZodiac(CharacterZodiac $characterZodiac): self
    {
        if (!$this->characterZodiacs->contains($characterZodiac)) {
            $this->characterZodiacs[] = $characterZodiac;
            $characterZodiac->setCharacter($this);
        }

        return $this;
    }

    public function removeCharacterZodiac(CharacterZodiac $characterZodiac): self
    {
        if ($this->characterZodiacs->contains($characterZodiac)) {
            $this->characterZodiacs->removeElement($characterZodiac);
            // set the owning side to null (unless already changed)
            if ($characterZodiac->getCharacter() === $this) {
                $characterZodiac->setCharacter(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|CharacterSkill[]
     */
    public function getCharacterSkills(): Collection
    {
        return $this->characterSkills;
    }

    public function addCharacterSkill(CharacterSkill $characterSkill): self
    {
        if (!$this->characterSkills->contains($characterSkill)) {
            $this->characterSkills[] = $characterSkill;
            $characterSkill->setCharacter($this);
        }

        return $this;
    }

    public function removeCharacterSkill(CharacterSkill $characterSkill): self
    {
        if ($this->characterSkills->contains($characterSkill)) {
            $this->characterSkills->removeElement($characterSkill);
            // set the owning side to null (unless already changed)
            if ($characterSkill->getCharacter() === $this) {
                $characterSkill->setCharacter(null);
            }
        }

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


    /**
     * @return Collection|FilterCharacter[]
     */
    public function getFilterReports(): Collection
    {
        return $this->filters;
    }

    public function addFilterReport( FilterCharacter $filter): self
    {
        if (!$this->filters->contains($filter)) {
            $this->filters[] = $filter;
            $filter->setPlayerCharacter($this);
        }

        return $this;
    }

    public function removeFilterReport( FilterCharacter $filter): self
    {
        if ($this->filters->contains($filter)) {
            $this->filters->removeElement($filter);
            // set the owning side to null (unless already changed)
            if ($filter->getPlayerCharacter() === $this) {
                $filter->setPlayerCharacter(null);
            }
        }

        return $this;
    }


}
