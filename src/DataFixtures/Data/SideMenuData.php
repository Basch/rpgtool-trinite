<?php

namespace App\DataFixtures\Data;


class SideMenuData
{
    public static $DATA = [
        [
            'id' => 1,
            'title' => 'Feuille de personnage',
            'route' => 'character-sheet',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 2,
            'title' => 'Test',
            'route' => 'home',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 3,
            'title' => 'Test MJ only',
            'route' => 'home',
            'master' => true,
            'player' => false,
        ],

    ];
}