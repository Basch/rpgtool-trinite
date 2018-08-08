<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 */
class Job
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Skill")
     */
    private $skills;

    /**
     * @ORM\Column(type="integer")
     */
    private $wealth;

    /**
     * @ORM\Column(type="integer")
     */
    private $network;

    /**
     * @ORM\Column(type="integer")
     */
    private $influence;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfDomains;

    /**
     * @ORM\Column(type="array")
     */
    private $domains;

    /**
     * @ORM\Column(type="integer")
     */
    private $creationPoints;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
        }

        return $this;
    }

    public function getWealth(): ?int
    {
        return $this->wealth;
    }

    public function setWealth(int $wealth): self
    {
        $this->wealth = $wealth;

        return $this;
    }

    public function getNetwork(): ?int
    {
        return $this->network;
    }

    public function setNetwork(int $network): self
    {
        $this->network = $network;

        return $this;
    }

    public function getInfluence(): ?int
    {
        return $this->influence;
    }

    public function setInfluence(int $influence): self
    {
        $this->influence = $influence;

        return $this;
    }

    public function getNumberOfDomains(): ?int
    {
        return $this->numberOfDomains;
    }

    public function setNumberOfDomains(int $numberOfDomains): self
    {
        $this->numberOfDomains = $numberOfDomains;

        return $this;
    }

    public function getDomains(): ?array
    {
        return $this->domains;
    }

    public function setDomains(array $domains): self
    {
        $this->domains = $domains;

        return $this;
    }

    public function getCreationPoints(): ?int
    {
        return $this->creationPoints;
    }

    public function setCreationPoints(int $creationPoints): self
    {
        $this->creationPoints = $creationPoints;

        return $this;
    }
}
