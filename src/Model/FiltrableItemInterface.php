<?php

namespace App\Model;


use App\Entity\PlayerCharacter;
use App\Entity\User;

interface FiltrableItemInterface
{

    public const USER_CREATABLE = false;

    public function getId();
    public function getSlug();

    public function getCreator(): ?User;
    public function setCreator(?User $creator);

    public function getOwner(): ?PlayerCharacter;
    public function setOwner(?PlayerCharacter $owner);


}