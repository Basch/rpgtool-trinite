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
            'assets_id' => [ 1,3,5 ],
        ],
        [
            // Personnage de basch sur campagne de Hugo
            'id' => 2,
            'user_id' => '1',
            'campaign_id' => '3',
            'name' => 'L\'enquèteur Nain',
            'assets_id' => [ 4 ],
        ],
        [
            // Personnage de vera sur campagne de Basch
            'id' => 3,
            'user_id' => '2',
            'campaign_id' => '1',
            'name' => 'Dame Nalek',
            'assets_id' => [ 6,3 ],
        ],
        [
            // Personnage de vera sur campagne de Hugo
            'id' => 4,
            'user_id' => '2',
            'campaign_id' => '3',
            'name' => 'Heuuu',
            'assets_id' => [ 5,1 ],
        ],
        [
            // Personnage de hugo sur campagne de basch
            'id' => 5,
            'user_id' => '3',
            'campaign_id' => '1',
            'name' => 'Benjiro',
            'assets_id' => [ 5,6,7 ],
        ],
        [
            // Personnage de hugo sur campagne de vera
            'id' => 6,
            'user_id' => '3',
            'campaign_id' => '2',
            'name' => 'Pirate',
            'assets_id' => [ 2,4 ],
        ],


    ];
}