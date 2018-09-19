<?php

namespace App\Service\Math;


use App\Entity\PlayerCharacter;
use App\Entity\Skill;

class StatisticsService
{
    public function totalSkillPoints( PlayerCharacter $character, Skill $skill ): int {

        $zodiacLevel = $character->getZodiacLevel( $skill->getZodiac() );
        $characterSkill = $character->getCharacterSkill( $skill );

        return $zodiacLevel + $characterSkill->getLevel();

    }

}