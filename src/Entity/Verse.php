<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VerseRepository")
 */
class Verse extends FiltrableItem
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
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $quote;

    /**
     * @ORM\Column(type="boolean")
     */
    private $karma;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $verseRange;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $area;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $stackable;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adam", inversedBy="verses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adam;


    public function __construct()
    {
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

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug( string $slug ): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getQuote(): ?string
    {
        return $this->quote;
    }

    public function setQuote(string $quote): self
    {
        $this->quote = $quote;

        return $this;
    }

    public function getKarma(): ?bool
    {
        return $this->karma;
    }

    public function setKarma(bool $karma): self
    {
        $this->karma = $karma;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getVerseRange(): ?string
    {
        return $this->verseRange;
    }

    public function setVerseRange(string $verseRange): self
    {
        $this->verseRange = $verseRange;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getStackable(): ?bool
    {
        return $this->stackable;
    }

    public function setStackable(?bool $stackable): self
    {
        $this->stackable = $stackable;

        return $this;
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

    public function getAdam(): ?Adam
    {
        return $this->adam;
    }

    public function setAdam(?Adam $adam): self
    {
        $this->adam = $adam;

        return $this;
    }

}
