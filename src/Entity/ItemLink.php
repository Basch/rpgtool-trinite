<?php

namespace App\Entity;

use App\Model\FiltrableItemInterface;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass() */
abstract class ItemLink
{
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $item_id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $item_type;

    public function getItemId() :int
    {
        return $this->item_id;
    }

    public function setItemId( int $item_id ) :self
    {
        $this->item_id = $item_id;
        return $this;
    }

    public function getItemType() :string
    {
        return $this->item_type;
    }

    public function setItemType( $item_type ) :self
    {
        $this->item_type = $item_type;
        return $this;
    }
}