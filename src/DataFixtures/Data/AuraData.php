<?php

namespace App\DataFixtures\Data;


class AuraData
{
    public static $DATA = [
        [
            'id' => 1,
            'zodiac_id' => 1,
            'description' => 'L\'Aura conforte les Adam\' qui ne choisissent pas franchement entre la Lumière et les Ténèbres ou qui se laissent aller aux penchants contraires à leurs convictions. Si, lors d\'un test, un joueur choisit le d12 opposé au Karma de son Adam\', le résultat final est augmenté de 2. Si l\'Adam\' ne possède pas de Karma, le résultat final est augmenté de 1 quel que soit le d12 choisi.',
            'breath' => 'Jusqu\'à la fin du round, les Adam\' peuvent choisir le dé opposé à leur Karma sans contracter de dette de Lumière ou de Ténèbres.',
        ],
        [
            'id' => 2,
            'zodiac_id' => 2,
            'description' => 'L\'Aura est une source de Karma. A chaque round, un point de Karma, de même nature que le Karma de l\'Adam\' de la Trinité à l\'origine de l\'Aura, est disponible dans l\'Aura - si le Karma de l\'Adam\' est égal à 0, l\'Aura est sans effet. Ce point doit être utilisé en même temps qu\'un autre point de même nature pour outrepasser les limites habituelles et ainsi accélérer ou amplifier une action - par exemple il s\'ajoute à un point de Ténèbres pour soigner 8 points de la ligne de vie Inconscient, il s\'ajoute à un point de Lumière pour activer plus rapidement un Atout, etc. Une fois dépensé, le point disparaît puis un autre apparaît au début du round suivant. L\'utilisation de ce point supplémentaire est une action libre.',
            'breath' => 'Jusqu\'à la fin du round, il est impossible de dépenser du Karma opposé à celui de l\'Adam\' qui déclenche le Souffle.',
        ],
        [
            'id' => 3,
            'zodiac_id' => 3,
            'description' => 'L\'Aura illustre le goût du challenge du Sagittaire et sa capacité à se dépasser par défi. Le joueur susceptible de réaliser un test avec 2d12 peut choisir de ne lancer que 1d12. En contrepartie, le résultat final du test augmente de 2 points.',
            'breath' => 'Jusqu\'à la fin du round, toutes les actions sont automatiquement assorties de la Pénalité Risque.',
        ],
        [
            'id' => 4,
            'zodiac_id' => 4,
            'description' => 'L\'Aura invite à la patience. Passer cinq secondes - un round en combat - à se concentrer avant un test de compétence permet d\'augmenter de 1 le résultat final. Ce temps de concentration est une action unique, réussie automatiquement.',
            'breath' => 'Jusqu\'à la fin du round, les actions gratuites sont considérées comme des actions libres, et les actions libres comme des actions uniques.',
        ],
        [
            'id' => 5,
            'zodiac_id' => 5,
            'description' => 'L\'Aura insuffle une ardeur belliqueuse. Les dégâts des attaques au corps à corps et en mêlée augmentent de 1 point.',
            'breath' => 'Chaque personne prise dans le Souffle subit une blessure de 1 point de dégâts. Les protections non magiques sont inopérantes contre cette agression.',
        ],
        [
            'id' => 6,
            'zodiac_id' => 6,
            'description' => 'L\'Aura protège. Elle accorde une armure naturelle de 2 points.',
            'breath' => 'Chaque personne prise dans le Souffle est soignée de 2 points de vie.',
        ],
        [
            'id' => 7,
            'zodiac_id' => 7,
            'description' => 'L\'Aura permet des réussites spectaculaires lorsque l\'esprit touche les points subtils d\'équilibre de l\'univers. Si, lors d\'un test réalisé avec 2d12, les deux dés indiquent le même nombre, le résultat naturel est calculé en additionnant ces deux nombres - sauf si deux 1 ont été obtenus, dans ce cas l\'Aura est inefficace contre cet échec automatique.',
            'breath' => 'Jusqu\'à la fin du round, les effets de l\'Aura de la Balance sont présents dans la zone du Souffle. De plus, le joueur de l\'Adam\' qui déclenche le Souffle lance 1d12. Jusqu\'à la fin du round, tout joueur, y compris le meneur de jeu pour les personnages qu\'il met en scène, qui obtient le même résultat naturel que celui de ce d12 calcule le résultat final de son test en multipliant par deux le résultat naturel de son test.',
        ],
        [
            'id' => 8,
            'zodiac_id' => 8,
            'description' => 'L\'Aura se joue de la frontière entre la Lumière et les Ténèbres. A l\'aube, le Karma-Ténèbres se régénere d\'un point. Au crépuscule, le Karma-Lumière se régénère d\'un point.',
            'breath' => 'Jusqu\'à la fin du round, les actions nécessitant habituellement une dépense de Karma-Lumière doivent être effectuées avec du Karma-Ténèbres. Celles nécessitant du Karma-Ténèbres doivent être effectuées avec du Karma-Lumière.',
        ],
        [
            'id' => 9,
            'zodiac_id' => 9,
            'description' => 'L\'Aura du Lion reflète le côté resplendissant de ce signe : elle transforme les réussites parfaites en succès éblouissants. Lors d\'un test, si le dé indique 12, le dé est relancé conformément aux règles habituelles. Mais le chiffre 12 est substitué au chiffre obtenu par ce deuxième jet pour déterminer le résultat naturel du test. Si le dé indique encore 12, les jets se poursuivent jusqu\'à ce qu\'un autre chiffre soit obtenu. C\'est alors ce dernier chiffre qui est remplacé par un 12.',
            'breath' => 'D\'ici la fin du round, chaque personne prise dans le Souffle ajoute 3 points au résultat final de sa prochaine action s\'il atteint 12.',
        ],
        [
            'id' => 10,
            'zodiac_id' => 10,
            'description' => 'L\'Aura permet de faire fi des limites habituelles des dépenses de Karma. Une des lignes de Karma peut être sollicitée plus intensément : deux points de cette ligne peuvent être dépensés par round. Le point supplémentaire doit être utilisé en même temps que l\'autre point pour accélerer ou amplifier une même action - par exemple il s\'ajoute à un point de Ténèbres pour soigner 8 points de la ligne de vie Inconscient, il s\'ajoute à un point de Lumière pour jouer plus rapidement un Atout, etc.',
            'breath' => 'D\'ici la fin du round, pour chaque personne, la prochaine action impliquant une dépense de Karma est considérée comme une action gratuite.',
        ],
        [
            'id' => 11,
            'zodiac_id' => 11,
            'description' => 'L\'Aura permet d\'éviter les échecs automatiques. Lors d\'un test de compétence, le joueur ou le meneur de jeu qui obtient un résultat naturel de 1 peut relancer le dé. S\'il obtient à nouveau un 1 naturel, il doit garder ce résultat.',
            'breath' => 'D\'ici la fin du round, chaque personne prise dans le Souffle relance les dés lors de sa prochaine action ou réaction ratée.',
        ],
        [
            'id' => 12,
            'zodiac_id' => 12,
            'description' => 'L\'Aura permet de mobiliser efficacement ses Karmas. L\'Aura procure la possibilité de dépasser la limite de la dépense maximum de deux points de Karma - un de Lumière et un de Ténèbres - par round. Cette dépense maximum passe à trois points, un par ligne de Karma : un point de Lumière de la ligne du Deva, un de Ténèbres de la ligne de l\'Archonte, un de Lumière ou de Ténèbres - selon la nature du Karma de l\'Adam\' - de la ligne de l\'Adam\'. Si deux points de Karma-Lumière ou de Karma-Ténèbres sont dépensés, le second de ces points doit être utilisé en même temps que l\'autre pour accélérer ou amplifier une même action - par exemple il s\'ajoute à un point de Ténèbres pour soigner 8 points de la ligne de vie Inconscient, il s\'ajoute à un point de Lumière pour jouer plus rapidement un Atout, etc.',
            'breath' => 'Jusqu\'à la fin du round, chaque personne prise dans le Souffle peut dépenser 2 points de Karma-Lumière ou 2 points de Karma-Ténèbres au lieu d\'1 de Lumière et d\'1 de Ténèbres.',
        ],

    ];
}