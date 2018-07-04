<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterSheetRepository")
 */
class CharacterSheet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterZodiac", mappedBy="characterSheet", orphanRemoval=true)
     */
    private $characterZodiacs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="characterSheets", cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterSkill", mappedBy="characterSheet", orphanRemoval=true)
     */
    private $characterSkills;

    public function __construct()
    {
        $this->characterZodiacs = new ArrayCollection();
        $this->characterSkills = new ArrayCollection();
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
            $characterZodiac->setCharacterSheet($this);
        }

        return $this;
    }

    public function removeCharacterZodiac(CharacterZodiac $characterZodiac): self
    {
        if ($this->characterZodiacs->contains($characterZodiac)) {
            $this->characterZodiacs->removeElement($characterZodiac);
            // set the owning side to null (unless already changed)
            if ($characterZodiac->getCharacterSheet() === $this) {
                $characterZodiac->setCharacterSheet(null);
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
            $characterSkill->setCharacterSheet($this);
        }

        return $this;
    }

    public function removeCharacterSkill(CharacterSkill $characterSkill): self
    {
        if ($this->characterSkills->contains($characterSkill)) {
            $this->characterSkills->removeElement($characterSkill);
            // set the owning side to null (unless already changed)
            if ($characterSkill->getCharacterSheet() === $this) {
                $characterSkill->setCharacterSheet(null);
            }
        }

        return $this;
    }
}
