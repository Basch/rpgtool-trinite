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

    public function __construct()
    {
        $this->characterZodiacs = new ArrayCollection();
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
}
