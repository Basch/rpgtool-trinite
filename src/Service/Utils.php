<?php

namespace App\Service;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Utils
{
    public static function ArrayToCollection( array $array ): Collection
    {
        $collection = new ArrayCollection();
        foreach( $array as $val ){
            $collection->add( $val );
        }
        return $collection;
    }
}