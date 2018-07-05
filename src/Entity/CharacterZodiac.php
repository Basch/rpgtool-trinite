<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterZodiacRepository")
 */
class CharacterZodiac
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
     * @ORM\ManyToOne(targetEntity="App\Entity\CharacterSheet", inversedBy="characterZodiacs", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $characterSheet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Zodiac", inversedBy="characterZodiacs", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $zodiac;

    public function __toString()
    {
        return 'CharacterZodiac #'.$this->getId();
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

    public function getZodiac(): ?Zodiac
    {
        return $this->zodiac;
    }

    public function setZodiac(?Zodiac $zodiac): self
    {
        $this->zodiac = $zodiac;

        return $this;
    }
}
