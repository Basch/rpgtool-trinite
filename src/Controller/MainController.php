<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {

        $pages = [
          [
            'name' => 'feuille de personnage',
            'link' => 'character.sheet'
          ]
        ];

        return $this->render('main/index.html.twig', [
            'pages' => $pages,
        ]);
    }
}
