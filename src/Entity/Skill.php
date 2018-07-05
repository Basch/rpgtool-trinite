<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkillRepository")
 */
class Skill
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
     * @ORM\Column(type="boolean")
     */
    private $domainRelated;

    /**
     * @ORM\Column(type="boolean")
     */
    private $open;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Zodiac", inversedBy="skills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zodiac;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterSkill", mappedBy="skill", orphanRemoval=true)
     */
    private $characterSkills;

    public function __construct()
    {
        $this->characterSkills = new ArrayCollection();
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

    public function getDomainRelated(): ?bool
    {
        return $this->domainRelated;
    }

    public function setDomainRelated(bool $domainRelated): self
    {
        $this->domainRelated = $domainRelated;

        return $this;
    }

    public function getOpen(): ?bool
    {
        return $this->open;
    }

    public function setOpen(bool $open): self
    {
        $this->open = $open;

        return $this;
    }

    public function getZodiac(): ?Zodiac
    {
        return $this->zodiac;
    }

    public function setZodiac(?Zodiac $zodiac): self
    {
        $this->zodiac = $zodiac;

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
            $characterSkill->setSkill($this);
        }

        return $this;
    }

    public function removeCharacterSkill(CharacterSkill $characterSkill): self
    {
        if ($this->characterSkills->contains($characterSkill)) {
            $this->characterSkills->removeElement($characterSkill);
            // set the owning side to null (unless already changed)
            if ($characterSkill->getSkill() === $this) {
                $characterSkill->setSkill(null);
            }
        }

        return $this;
    }
}
