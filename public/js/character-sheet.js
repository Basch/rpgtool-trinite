$( function () {
    let characterSheet = {

        init: function() {
            characterSheet.config = {
                skill_buttons: $('.cs-skill-button'),
            };

            //$.extend( characterSheet.config, settings );

            characterSheet.bind();

        },

        bind: function() {
            characterSheet.config.skill_buttons.on( 'click', characterSheet.skillModify );
        },

        skillModify : function ( event ) {
            event.preventDefault();

            const zodiac_id = $( this ).data('zodiac-id');
            const skill_id = $( this ).data('skill-id');
            const act = $( this ).data('skill-act');

            const zodiac_lvl = parseInt( $("#zodiac-" + zodiac_id ).html() );

            let $skill = $("#skill-" + skill_id );
            let $skill_total = $("#skill-total-" + skill_id );
            let skill_lvl = parseInt( $skill.html() );

            switch( act ) {
                case 'add' : skill_lvl++; break;
                case 'sub' : skill_lvl--; break;
            }

            if( skill_lvl < 0 ) { skill_lvl = 0; }

            $skill.html( skill_lvl );
            $skill_total.html( skill_lvl + zodiac_lvl );

        },

    };

    characterSheet.init()

});