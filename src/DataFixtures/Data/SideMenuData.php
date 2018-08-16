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
            'title' => 'Atouts',
            'route' => 'asset',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 3,
            'title' => 'Auras',
            'route' => 'aura',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 4,
            'title' => 'Versets',
            'route' => 'verse',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 8,
            'title' => 'Rapports',
            'route' => 'report',
            'master' => true,
            'player' => true,
        ],

    ];
}