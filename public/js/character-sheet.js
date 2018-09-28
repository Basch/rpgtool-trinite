$( function () {
    let characterSheet = {

        init: function() {
            characterSheet.config = {
                skill_buttons: $('.cs-skill-button'),
            };

            //$.extend( characterSheet.config, settings );
            characterSheet.$experience = $('#data-experience');
            characterSheet.experience = parseInt( characterSheet.$experience.html() );

            characterSheet.bind();

        },

        bind: function() {
            characterSheet.config.skill_buttons.on( 'click', characterSheet.btnSkillModify );
        },

        btnSkillModify : function ( event ) {
            event.preventDefault();

            const zodiac_id = $( this ).data('zodiac-id');
            const skill_id = $( this ).data('skill-id');
            const act = $( this ).data('skill-act');

            const zodiac_lvl = parseInt( $("#data-zodiac-" + zodiac_id ).html() );

            let $skill = $("#data-skill-" + skill_id );
            let $skill_total = $("#data-skill-total-" + skill_id );
            let skill_lvl = parseInt( $skill.html() );

            let data = characterSheet.skillModify( act, skill_lvl, zodiac_lvl );

            $skill.html( data.skill_lvl );
            $skill_total.html( data.skill_total_lvl );

        },

        skillModify : function ( act, skill_lvl, zodiac_lvl ) {
            switch( act ) {
                case 'add' :
                    if ( characterSheet.spendExperience( Math.ceil( ( skill_lvl + 1 ) / 2 ) ) ) {
                        skill_lvl++;
                    }
                    break;
                case 'sub' :
                    if( skill_lvl > 0 ){
                        characterSheet.gainExperience( Math.ceil( skill_lvl / 2 ) );
                        skill_lvl--;
                    }
                    break;
            }

            let skill_total_lvl = skill_lvl + zodiac_lvl;

            return {
                skill_lvl: skill_lvl,
                skill_total_lvl: skill_total_lvl,
            }
        },

        spendExperience: function ( xp ) {
            if( xp > characterSheet.experience ) {
                return false;
            }
            characterSheet.experience -= xp;
            characterSheet.refreshExperience();
            return true;
        },

        gainExperience: function ( xp ) {
            characterSheet.experience += xp;
            characterSheet.refreshExperience();
        },

        refreshExperience: function () {
            characterSheet.$experience.html( characterSheet.experience );
        }



    };

    characterSheet.init()

});