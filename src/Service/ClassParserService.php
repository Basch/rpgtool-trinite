<?php

namespace App\Service;


use Doctrine\ORM\EntityManagerInterface;

class ClassParserService
{
    private $em;

    public function __construct( EntityManagerInterface $entityManager )
    {
        $this->em = $entityManager;
    }

    public function parseClass( string $path ): string {
        $array = explode('\\', $path );
        return end($array );
    }

    public function getClass( $object ) {
        if( !is_object( $object )) return '';

        //$entityName = $this->em->getMetadataFactory()->getMetadataFor(get_class($object))->getName();
        //return $this->parseClass( $entityName );
        return  get_class($object) ;
    }
}