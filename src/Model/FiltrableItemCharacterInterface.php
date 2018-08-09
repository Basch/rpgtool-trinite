<?php

namespace App\Model;


use Doctrine\Common\Collections\Collection;

interface FiltrableItemCharacterInterface
{

    public function getId();

    /**
     * @return Collection|FilterCharacterInterface[]
     */
    public function getFilterCharacter();

}