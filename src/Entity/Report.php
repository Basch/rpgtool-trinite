<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReportRepository")
 */
class Report extends FiltrableItem
{

    public const USER_CREATABLE = true;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateModified;

    /**
     * @ORM\Column(type="date")
     */
    private $dateGame;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlayerCharacter", inversedBy="reports")
     */
    private $writer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campaign", inversedBy="reports")
     * @ORM\JoinColumn(nullable=false)
     */
    private $campaign;

    /**
     * @ORM\Column(type="text")
     */
    private $text;


    public function __construct()
    {
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getDateGame(): ?\DateTimeInterface
    {
        return $this->dateGame;
    }

    public function setDateGame(\DateTimeInterface $dateGame): self
    {
        $this->dateGame = $dateGame;

        return $this;
    }

    public function getWriter(): ?PlayerCharacter
    {
        return $this->writer;
    }

    public function setWriter(?PlayerCharacter $writer): self
    {
        $this->writer = $writer;

        return $this;
    }

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): self
    {
        $this->campaign = $campaign;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }


}
