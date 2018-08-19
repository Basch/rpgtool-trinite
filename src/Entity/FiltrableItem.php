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
     */
    protected $owner;

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator)
    {
        $this->creator = $creator;

        return $this;
    }

    public function getOwner(): ?PlayerCharacter
    {
        return $this->owner;
    }

    public function setOwner(?PlayerCharacter $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    public function getUserCreatable() {
        return self::USER_CREATABLE;
    }
}