<?php

namespace App\DataFixtures\Data;


class MenuData
{
    public static $DATA = [
        [
            'id' => 1,
            'title' => 'Personnage',
            'route' => 'character-sheet',
            'icon' => 'clipboard-list ',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 2,
            'title' => 'Atouts',
            'route' => 'asset',
            'icon' => 'hand-paper',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 3,
            'title' => 'Auras',
            'route' => 'aura',
            'icon' => 'eye',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 4,
            'title' => 'Versets',
            'route' => 'verse',
            'icon' => 'dot-circle ',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 5,
            'title' => 'Rapports',
            'route' => 'report',
            'icon' => 'file-alt',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 6,
            'title' => 'Journaux',
            'route' => 'newspaper',
            'icon' => 'newspaper',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 7,
            'title' => 'PNJ',
            'route' => 'nonplayercharacter',
            'icon' => 'users',
            'master' => true,
            'player' => true,
        ],
        [
            'id' => 8,
            'title' => 'Lieux',
            'route' => 'location',
            'icon' => 'globe-africa',
            'master' => true,
            'player' => true,
        ],

    ];
}