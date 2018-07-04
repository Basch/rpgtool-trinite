<?php

namespace App\Controller;

use App\Entity\CharacterSheet;
use App\Entity\User;
use http\Url;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CharacterSheetController extends Controller
{

    /**
     * @Route("/character/sheet/list", name="character.sheet.list")
     */
    public function list()
    {
        /** @var CharacterSheet[] $characterSheets */
        $characterSheets = $this->getDoctrine()->getRepository( CharacterSheet::class )->findAll();

        $pages = [];

        foreach( $characterSheets as $characterSheet ){
            $pages[] = [
                'name' => $characterSheet->getUser()->getUsername() . ' - ' . $characterSheet->getId(),
                'link' => $this->generateUrl('character.sheet.show', [ 'characterSheet' => $characterSheet->getId() ] ),

            ];
        }

        return $this->render( 'main/index.html.twig', [
            'pages' => $pages,
        ] );
    }


    /**
     * @Route("/character/sheet/{characterSheet}", name="character.sheet.show")
     */
    public function show( CharacterSheet $characterSheet )
    {
        //$user = current( $this->getDoctrine()->getRepository( User::class )->findAll() );
        //$characterSheet = current( $this->getDoctrine()->getRepository( CharacterSheet::class )->findBy( [ 'user' => $user->getId() ] ) );
        dump( $characterSheet );
        return $this->render( 'character_sheet/index.html.twig', [
            'characterSheet' => $characterSheet,
        ] );
    }
}
