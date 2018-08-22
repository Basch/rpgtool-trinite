<?php

namespace App\Entity;
use App\Model\FiltrableItemInterface;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass() */
abstract class FiltrableItem implements FiltrableItemInterface
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $creator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlayerCharacter")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $writer;


    public function __toString()
    {
        if( $this->getId() > 0 )
            return $this->getName();
        else
            return "Nouveau";
    }

    final public function getCreator(): ?User
    {
        return $this->creator;
    }

    final public function setCreator(?User $creator)
    {
        $this->creator = $creator;

        return $this;
    }

    final public function getWriter(): ?PlayerCharacter
    {
        return $this->writer;
    }

    final public function setWriter(?PlayerCharacter $writer)
    {
        $this->writer = $writer;

        return $this;
    }

    public function getUserCreatable() {
        return self::USER_CREATABLE;
    }
}