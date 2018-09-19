<?php

namespace App\Twig;


use App\Entity\PlayerCharacter;
use App\Service\FilterService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CharacterItemExtension extends AbstractExtension
{

    private $filter;

    public function __construct( FilterService $filter )
    {
        $this->filter = $filter;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('itemsOwned', [$this, 'itemsOwned'], ['is_safe' => ['html']]),
        ];
    }

    public function itemsOwned( PlayerCharacter $character, string $class ) {

        $class = 'App\Entity\\'.$class;
        return $this->filter->getPlayerOwnedItems( $class, $character );
    }
}