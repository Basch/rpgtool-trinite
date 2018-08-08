<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuraRepository")
 */
class Aura
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $breath;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Zodiac", inversedBy="aura", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $sign;

    public function getId()
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBreath(): ?string
    {
        return $this->breath;
    }

    public function setBreath(string $breath): self
    {
        $this->breath = $breath;

        return $this;
    }

    public function getSign(): ?Zodiac
    {
        return $this->sign;
    }

    public function setSign(Zodiac $sign): self
    {
        $this->sign = $sign;

        return $this;
    }
}
