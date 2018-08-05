<?php

namespace App\DataFixtures\Data;


class CharacterData
{
    public static $DATA = [
        [
            // Personnage de basch sur campagne de Vera
            'id' => 1,
            'user_id' => '1',
            'campaign_id' => '2',
            'name' => 'Igor',
        ],
        [
            // Personnage de basch sur campagne de Hugo
            'id' => 2,
            'user_id' => '1',
            'campaign_id' => '3',
            'name' => 'L\'enquèteur Nain',
        ],
        [
            // Personnage de vera sur campagne de Basch
            'id' => 3,
            'user_id' => '2',
            'campaign_id' => '1',
            'name' => 'Dame Nalek',
        ],
        [
            // Personnage de vera sur campagne de Hugo
            'id' => 4,
            'user_id' => '2',
            'campaign_id' => '3',
            'name' => 'Heuuu',
        ],
        [
            // Personnage de hugo sur campagne de basch
            'id' => 5,
            'user_id' => '3',
            'campaign_id' => '1',
            'name' => 'Benjiro',
        ],
        [
            // Personnage de hugo sur campagne de vera
            'id' => 6,
            'user_id' => '3',
            'campaign_id' => '2',
            'name' => 'Pirate',
        ],


    ];
}