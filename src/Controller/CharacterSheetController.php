<?php

namespace App\Controller;

use App\Entity\PlayerCharacter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CharacterSheetController extends Controller
{

    /**
     * @Route("/character/sheet/list", name="character.sheet.list")
     */
    public function list()
    {
        /** @var PlayerCharacter[] $characterSheets */
        $characterSheets = $this->getDoctrine()->getRepository( PlayerCharacter::class )->findAll();

        $pages = [];

        foreach( $characterSheets as $characterSheet ){
            $pages[] = [
                'name' => $characterSheet->getUser()->getUsername() . ' - ' . $characterSheet->getId(),
                'link' => $this->generateUrl('character.sheet.show', [ 'characterSheet' => $characterSheet->getId() ] ),

            ];
        }

        return $this->render( 'pages/main/campaigns.html.twig', [
            'pages' => $pages,
        ] );
    }


    /**
     * @Route("/character/sheet/{characterSheet}", name="character.sheet.show")
     */
    public function show( PlayerCharacter $characterSheet )
    {
        //$user = current( $this->getDoctrine()->getRepository( User::class )->findAll() );
        //$characterSheet = current( $this->getDoctrine()->getRepository( PlayerCharacter::class )->findBy( [ 'user' => $user->getId() ] ) );
        dump( $characterSheet );
        return $this->render( 'pages/character_sheet/campaigns.html.twig', [
            'characterSheet' => $characterSheet,
        ] );
    }
}
