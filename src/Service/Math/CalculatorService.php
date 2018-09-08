<?php

namespace App\Service\Math;


class CalculatorService
{
    public function rotate( int $seed, int $min = -3, int $max = 3, int $resolution = 10  ) {
        //srand( $seed );
        return rand( $min * $resolution , $max * $resolution ) / $resolution;
    }
}