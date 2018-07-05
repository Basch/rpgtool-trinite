<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZodiacRepository")
 */
class Zodiac
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
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterZodiac", mappedBy="zodiac", orphanRemoval=true)
     */
    private $characterZodiacs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Skill", mappedBy="zodiac", orphanRemoval=true)
     */
    private $skills;

    public function __construct()
    {
        $this->characterZodiacs = new ArrayCollection();
        $this->skills = new ArrayCollection();
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
            $characterZodiac->setZodiac($this);
        }

        return $this;
    }

    public function removeCharacterZodiac(CharacterZodiac $characterZodiac): self
    {
        if ($this->characterZodiacs->contains($characterZodiac)) {
            $this->characterZodiacs->removeElement($characterZodiac);
            // set the owning side to null (unless already changed)
            if ($characterZodiac->getZodiac() === $this) {
                $characterZodiac->setZodiac(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setZodiac($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
            // set the owning side to null (unless already changed)
            if ($skill->getZodiac() === $this) {
                $skill->setZodiac(null);
            }
        }

        return $this;
    }
}
