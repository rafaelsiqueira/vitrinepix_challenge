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
                $('#attack-tip').html('<div class="alert alert-warning" role="alert">The "' + players[0].player_name + '" will initiate the attack</div>');

                // enables attack start
                $('#attack-step-start').show();


            }, 'json');
        };

        this.attack = function(e) {
            $(e.target).remove();

            $.get('/game/attack', function(results){
                for(var i in results) {

                    cssClass = '';

                    if(results[i].attack.success) {
                        cssClass = 'success';

                    } else if( results[i].attack.attack_points === results[i].attack.defense_points ) {
                        cssClass = 'warning';

                    } else {
                        cssClass = 'danger';
                    }

                    $('#results-table').append(
                           '<tr class="'+ cssClass +'">'
                         + '  <td>'+ ( parseInt(i) + 1 ) +'</td>' //round number
                         + '  <td>'+ results[i].attacker +'</td>'
                         + '  <td>'+ results[i].defender +'</td>'
                         + '  <td>'+ results[i].attack.attack_points +'</td>'
                         + '  <td>'+ results[i].attack.defense_points +'</td>'
                         + '  <td>'+ (results[i].attack.damage ? results[i].attack.damage : 0) +'</td>'
                         + '  <td>'+ results[i].attack.remaining_health +'</td>'
                         + '</tr>'
                    );
                }

                $('#attack-tip').append('<div class="alert alert-info" role="alert">The "'+ results[ results.length-1].attacker +'" wins!</div>')

                $('#results-container').show();

            }, 'json');
        };
    };

    $(function(){
        var game = new Game();

        // add events
        $('#initiative-step-start').click(game.initiative);
        $('#attack-step-start').click(game.attack);
        $('#new-game').click(function(){
            window.location.reload();
        });

    });

})(jQuery);