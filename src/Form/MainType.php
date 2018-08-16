<?php

namespace App\Form;

use App\Entity\Asset;
use App\Entity\SideMenu;
use App\Service\FilterService;
use App\Service\FilterPlayerService;
use App\Service\UserDataService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class MainType extends AbstractType
{
    protected $userData;
    protected $filter;

    public function __construct( UserDataService $userData, FilterService $filter)
    {
        $this->userData = $userData;
        $this->filter = $filter;
    }

}
