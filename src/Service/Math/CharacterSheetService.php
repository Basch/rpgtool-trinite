<?php

namespace App\Service\Math;


use App\Entity\CharacterSkill;
use App\Entity\PlayerCharacter;
use App\Entity\Skill;

class CharacterSheetService
{
    public function totalSkillPoints( PlayerCharacter $character, Skill $skill ): int {

        $zodiacLevel = $character->getZodiacLevel( $skill->getZodiac() );
        $characterSkill = $character->getCharacterSkill( $skill );

        return $zodiacLevel + $characterSkill->getLevel();

    }

    public function addSkillPoint( CharacterSkill &$characterSkill ) {
        $level = $characterSkill->getLevel() + 1;
        $characterSkill->setLevel( $level );
    }

    public function subSkillPoint( CharacterSkill &$characterSkill ) {
        $level = $characterSkill->getLevel() - 1;
        if( $level < 0 ) $level = 0;
        $characterSkill->setLevel( $level );
    }

}