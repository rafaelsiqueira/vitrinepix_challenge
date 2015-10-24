(function($){

    var Game = function() {
        this.initiative = function(e) {
            $(e.target).remove();

            $.get('/game/initiative', function(players){

                // update players list
                $('#players-list').html('');
                for(var i in players) {
                    order = '#' + (parseInt(i) + parseInt(1));
                    $('#players-list').append(
                        '<li class="list-group-item">'+ players[i].player_name +'<span class="badge">'+ order +'</span></li>'
                    );
                }

                // cleanup attack-tip
                $('#attack-tip').html('The "' + players[0].player_name + '" will initiate the attack');

                // enables attack start
                $('#attack-step-start').show();


            }, 'json');
        };

        this.attack = function(e) {
            $(e.target).remove();


        };
    };

    $(function(){
        var game = new Game();

        // add events
        $('#initiative-step-start').click(game.initiative);
        $('#attack-step-start').click(game.attack);

    });

})(jQuery);