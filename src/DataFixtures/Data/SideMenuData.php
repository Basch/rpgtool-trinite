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
            'id' => 5,
            'title' => 'Rapports',
            'route' => 'report',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 6,
            'title' => 'Journaux',
            'route' => 'newspaper',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 7,
            'title' => 'PNJ',
            'route' => 'nonplayercharacter',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 8,
            'title' => 'Lieux',
            'route' => 'location',
            'master' => true,
            'player' => true,
        ],

    ];
}