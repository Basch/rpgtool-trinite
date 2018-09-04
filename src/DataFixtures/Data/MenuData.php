<?php

namespace App\DataFixtures\Data;


class MenuData
{
    public static $DATA = [
        [
            'id' => 1,
            'title' => 'Feuille de personnage',
            'route' => 'character-sheet',
            'icon' => 'file-alt',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 2,
            'title' => 'Atouts',
            'route' => 'asset',
            'icon' => '',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 3,
            'title' => 'Auras',
            'route' => 'aura',
            'icon' => '',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 4,
            'title' => 'Versets',
            'route' => 'verse',
            'icon' => '',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 5,
            'title' => 'Rapports',
            'route' => 'report',
            'icon' => '',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 6,
            'title' => 'Journaux',
            'route' => 'newspaper',
            'icon' => '',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 7,
            'title' => 'PNJ',
            'route' => 'nonplayercharacter',
            'icon' => '',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 8,
            'title' => 'Lieux',
            'route' => 'location',
            'icon' => '',
            'master' => true,
            'player' => true,
        ],

    ];
}