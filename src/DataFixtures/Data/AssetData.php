<?php

namespace App\DataFixtures\Data;


class AssetData
{
    public static $DATA = [
        [
            'id' => 1,
            'name' => 'Miroir',
            'color' => 'Sinople',
            'description' => 'Le personnage désigne la Lame-Soeur d\'un de ses alliés. Sa surface devient comme un miroir. Elle copie le prochain Atout joué. A son prochain tour, le propriétaire de l\'épée-miroir peut jouer cet Atout sans avoir à dépenser de Karma. Il ne peut pas jouer un autre Atout en plus. En revanche, il peut le faire à la place de l\'Atout copié : Miroir prend alors fin. Si l\'épée-miroir est rengainée avant qu\'un Atout ne soit joué, l\'effet disparaît.',
            'fire_blade_id' => 1,
            'karma' => true,
        ],
        [
            'id' => 2,
            'name' => 'Vague',
            'color' => 'Azur',
            'description' => 'Une vague invisible submerge les adversaires engagés contre le personnage. Ils sont repoussés en arrière et sont désengagés. Ils ne peuvent s\'opposer aux éventuels déplacements du personnage. De plus, ils chutent, à moins de réussir un test obligatoire d\'Esquive/0.',
            'fire_blade_id' => 1,
            'karma' => true,
        ],
        [
            'id' => 3,
            'name' => 'Secousse',
            'color' => 'Sable',
            'description' => 'En frappant le sol de sa Lame-soeur, l\'Adam\' provoque des soubresauts telluriques sous les pieds d\'ennemis. Lors de leur prochain test, les victimes subissent une Pénalité de leur choix s\'il s\'agit d\'une réaction. L\'Adam\' choisit ses victimes, il peut donc épargner ses compagnons. En revanche, les victimes doivent être visibles par le personnage.',
            'fire_blade_id' => 2,
            'karma' => true,
        ],
        [
            'id' => 4,
            'name' => 'Vigueur',
            'color' => 'Azur',
            'description' => 'Le personnage accroît sa force. Le résultat final de sa prochaine attaque avec la Lame-soeur augmente de 3 points. Les dégâts augmentent de 6.',
            'fire_blade_id' => 2,
            'karma' => true,
        ],
        [
            'id' => 5,
            'name' => 'Flamme',
            'color' => 'Gueules',
            'description' => 'La Lame-soeur s\'enflamme. Jusqu\'à la fin du round, ses dégâts augmentent de 4.',
            'fire_blade_id' => 3,
            'karma' => true,
        ],
        [
            'id' => 6,
            'name' => 'Cercle',
            'color' => 'Sable',
            'description' => 'Un cercle de feu s\'élève brièvement autour du personnage. Toutes les personnes à proximité directe du personnage, et notamment les adversaires engagés contre lui, subissent 4 points de dégâts.',
            'fire_blade_id' => 3,
            'karma' => true,
        ],
        [
            'id' => 7,
            'name' => 'Immatérielle',
            'color' => 'Sinople',
            'description' => 'Le personnage désigne la Lame-soeur d\'un de ses alliés. Elle est entourée de volutes d\'air. Lors de sa prochaine attaque, elle devient immatérielle un bref instant puis reprend consistance au moment de mordre la chair de l\'adversaire. Si l\'adversaire réagit à cette attaque en essayant de parer, sa tentative est un échec automatique. S\'il réagit en essayant d\'esquiver, le résultat final du test diminue de 3. Si l\'épée entourée de volutes d\'air est rengainée avant qu\'une attaque ne soit portée, l\'effet disparaît.',
            'fire_blade_id' => 4,
            'karma' => true,
        ],
        [
            'id' => 8,
            'name' => 'Foudre',
            'color' => 'Gueules',
            'description' => 'Un éclair jaillit de la pointe de la Lame-soeur et va frapper une cible visible désignée par le personnage. Le joueur effectue un test de Mêlée, modifié par les difficultés de Tir - action libre. Cette foudre occasionne 8 points de dégâts. Aucun obstacle ne doit s\'interposer entre la cible et la pointe de la Lame-soeur.',
            'fire_blade_id' => 4,
            'karma' => true,
        ],
        
    ];
}