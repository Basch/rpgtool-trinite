<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterSkillRepository")
 */
class CharacterSkill
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharacterSheet", inversedBy="characterSkills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $characterSheet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Skill", inversedBy="characterSkills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;

    public function __toString()
    {
        return 'CharacterSkill #'.$this->getId();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getCharacterSheet(): ?CharacterSheet
    {
        return $this->characterSheet;
    }

    public function setCharacterSheet(?CharacterSheet $characterSheet): self
    {
        $this->characterSheet = $characterSheet;

        return $this;
    }

    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

        return $this;
    }
}
