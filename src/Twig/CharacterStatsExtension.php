<?php

namespace App\Twig;


use App\Entity\PlayerCharacter;
use App\Entity\Skill;
use App\Service\Math\CharacterSheetService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CharacterStatsExtension extends AbstractExtension
{

    private $stats;

    public function __construct( CharacterSheetService $stats )
    {
        $this->stats = $stats;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('skillTotal', [$this, 'skillTotal'] ),
        ];
    }

    public function skillTotal( PlayerCharacter $character, Skill $skill ): int
    {
        return $this->stats->totalSkillPoints( $character, $skill );
    }
}