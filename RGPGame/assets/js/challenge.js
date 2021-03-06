(function($){

    var Game = function() {
        this.initiative = function(e) {
            $(e.target).remove();

            $.get('/game/initiative', function(players){

                // update players list
                $('#players-list').html('');
                for(var i in players) {
                    order = players[i].initiative_point;
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

    var Admin = function() {


        this.createPlayer = function(e) {
            _execute('create', 'player', 'new')
                .done(function(data){
                    if(data.success) {
                        window.location.reload();

                    } else {
                        $('#message-box').html('<div class="alert alert-danger" role="alert">'+ data.message +'</div>');
                    }
                }
            );
        };

        this.deletePlayer = function(e) {
            if(confirm('Are you sure?')) {
                var request = $.post('/admin/delete_player', 'player_id=' + _playerId(e), null, 'json');
                request.done(function (data) {
                    if (data.success) {
                        window.location.reload();

                    } else {
                        $('#message-box').html('<div class="alert alert-danger" role="alert">' + data.message + '</div>');
                    }
                });

                request.fail(function () {
                    $('#message-box').html('<div class="alert alert-danger" role="alert">Internal server error!</div>');
                });
            }
        };

        this.updatePlayer = function(e) {
            _update('player', _playerId(e));
        };

        this.updateWeapon = function(e) {
            var weaponId = $(e.target).data('item');
            _update('weapon', weaponId);
        };

        function _playerId(e) {
            return $(e.target).data('item');
        }

        function _update(item, itemId) {
            _execute('update', item, itemId)
                .done(function(data){
                    if(data.success) {
                        $('#message-box').html('<div class="alert alert-success" role="alert">Update success!</div>');
                    } else {
                        $('#message-box').html('<div class="alert alert-danger" role="alert">'+ data.message +'</div>');
                    }
                }
            );
        }

        function _execute(action, item, itemId) {
            var payload  = [];
            $('#form-'+ item +' input[name^='+ item +'\\['+ itemId + '\\]]').each(function(i, el){
                payload.push($(el).attr('name') + '=' + $(el).val());
            });

            $('#form-'+ item +' select[name^='+ item +'\\['+ itemId + '\\]]').each(function(i, el){
                payload.push($(el).attr('name') + '=' + $(el).val());
            });

            var request = $.post('/admin/'+ action + '_' + item, payload.join('&'), null, 'json');

            request.fail(function(){
                $('#message-box').html('<div class="alert alert-danger" role="alert">Internal server error!</div>');
            });

            return request;
        }
    };

    $(function(){

        var game = new Game();

        // add events
        $('#initiative-step-start').click(game.initiative);
        $('#attack-step-start').click(game.attack);
        $('#new-game').click(function(){
            window.location.reload();
        });

        // admin
        if(window.location.pathname.indexOf('/admin') != -1) {
            $('#inputPassword').focus();

            var admin = new Admin();

            if($('#available-players').length > 0) {
                $('#available-players button').each(function(index, elem){
                    $(elem).click(admin[ $(elem).data('action') + 'Player' ]);
                });
            }

            if($('#available-weapons').length > 0) {
                $('#available-weapons button').each(function(index, elem){
                    $(elem).click(admin.updateWeapon);
                });
            }
        }
    });

})(jQuery);