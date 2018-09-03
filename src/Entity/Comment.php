<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment extends ItemLink
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlayerCharacter", inversedBy="writedComments")
     */
    private $writer;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="date")
     */
    private $dateGame;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

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
}
