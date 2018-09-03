<?php

namespace App\Service;

use Psr\Container\ContainerInterface;

class TwigService
{
    private $container;

    public function __construct( ContainerInterface $container )
    {
        $this->container = $container;
    }

    public function getUser() {
        return $this->container->get( UserDataService::class );
    }

    public function getFilter() {
        return $this->container->get( FilterService::class );
    }

    public function getComment() {
        return $this->container->get( CommentService::class );
    }
}