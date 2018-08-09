<?php

namespace App\Model;


use App\Entity\PlayerCharacter;

interface FilterCharacterInterface
{

    public function getCharacter(): ?PlayerCharacter;

    public function setCharacter(?PlayerCharacter $playerCharacter);

    public function getVisible(): ?bool;

    public function setVisible(bool $visible);

    public function getOwned(): ?bool;

    public function setOwned(bool $owned);

}