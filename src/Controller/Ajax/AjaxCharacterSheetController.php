<?php

namespace App\Controller\Ajax;

use App\Entity\PlayerCharacter;
use App\Entity\Skill;
use App\Service\Math\CharacterSheetService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AjaxCharacterSheetController extends Controller
{
    private $calc;
    private $em;

    public function __construct( CharacterSheetService $calc )
    {
        $this->calc = $calc;
        $this->em = $this->getDoctrine()->getManager();
    }

    /**
     * @Route("/ajax/character-{character}/skill-{skill}/modify-{act}", name="ajax.character.skill.modify")
     */
    public function skillModify( PlayerCharacter $character, Skill $skill, string $act ) {

        $characterSkill = $character->getCharacterSkill( $skill );

        switch ( $act ) {
            case 'add' :
                $this->calc->addSkillPoint( $characterSkill );
                break;
            case 'sub' :
                $this->calc->subSkillPoint( $characterSkill );
                break;
        }
        $this->em->flush();
    }



}
