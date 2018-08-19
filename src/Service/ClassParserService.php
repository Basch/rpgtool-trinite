<?php

namespace App\Service;


use Doctrine\ORM\EntityManagerInterface;

class ClassParserService
{
    private $em;

    public function __construct( EntityManagerInterface $entityManager ) {
        $this->em = $entityManager;
    }

    public function parseClass( string $path ): string {
        $array = explode('\\', $path );
        return end($array );
    }

    public function getClass( $object ) {
        if( !is_object( $object )) return '';
        return  get_class($object) ;
    }
}