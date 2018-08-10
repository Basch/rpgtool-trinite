<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdamRepository")
 */
class Adam
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
     * @ORM\OneToMany(targetEntity="App\Entity\Verse", mappedBy="adam")
     */
    private $verses;

    public function __construct()
    {
        $this->verses = new ArrayCollection();
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
     * @return Collection|Verse[]
     */
    public function getVerses(): Collection
    {
        return $this->verses;
    }

    public function addVerse(Verse $verse): self
    {
        if (!$this->verses->contains($verse)) {
            $this->verses[] = $verse;
            $verse->setAdam($this);
        }

        return $this;
    }

    public function removeVerse(Verse $verse): self
    {
        if ($this->verses->contains($verse)) {
            $this->verses->removeElement($verse);
            // set the owning side to null (unless already changed)
            if ($verse->getAdam() === $this) {
                $verse->setAdam(null);
            }
        }

        return $this;
    }
}
