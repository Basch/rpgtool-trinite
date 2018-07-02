<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CharacterSheetController extends Controller
{
    /**
     * @Route("/character/sheet", name="character.sheet")
     */
    public function index()
    {
        return $this->render('character_sheet/index.html.twig', [

        ]);
    }
}
