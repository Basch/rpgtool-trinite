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
     * @ORM\ManyToOne(targetEntity="PlayerCharacter", inversedBy="characterZodiacs", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $character;

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

    public function getCharacter(): ?PlayerCharacter
    {
        return $this->character;
    }

    public function setCharacter( ?PlayerCharacter $character): self
    {
        $this->character = $character;

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
