<?php

namespace App\Form\Entities;

use App\Service\FilterService;
use App\Service\UserDataService;
use Symfony\Component\Form\AbstractType;

abstract class GenericType extends AbstractType
{
    protected $userData;
    protected $filter;

    public function __construct( UserDataService $userData, FilterService $filter)
    {
        $this->userData = $userData;
        $this->filter = $filter;
    }

}
