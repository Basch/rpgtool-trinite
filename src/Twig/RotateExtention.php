<?php

namespace App\Twig;


use App\Service\Math\CalculatorService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RotateExtention extends AbstractExtension
{

    private $calculator;

    public function __construct( CalculatorService $calculator )
    {
        $this->calculator = $calculator;
    }

    public function getFunctions()
    {
        return [
          new TwigFunction('rotate', [$this, 'rotate']),
        ];
    }

    public function rotate( int $id ) {
        return $this->calculator->rotate( $id );
    }
}