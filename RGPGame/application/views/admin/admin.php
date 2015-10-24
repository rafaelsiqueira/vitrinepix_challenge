<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<ol class="breadcrumb">
    <li><a href="/game">Home</a></li>
    <li class="active">Admin</li>
</ol>

<div id="message-box" class="col-lg-12">
</div>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Players</h3>
        </div>
        <div class="panel-body">
            <form id="form-player">
                <table class="table" id="available-players">
                    <tr>
                        <th>#</th><th>Name</th><th>Strength</th><th>Agility</th><th>Health</th><th></th>
                    </tr>
                    <?php foreach($players as $player): ?>
                    <tr>
                        <td><?php echo $player->player_id ?></td>
                        <td><input value="<?php echo $player->player_name ?>" type="text" class="form-control" name="player[<?php echo $player->player_id ?>][name]" required /></td>
                        <td><input value="<?php echo $player->strength ?>" type="number" class="form-control" name="player[<?php echo $player->player_id ?>][strength]" required /></td>
                        <td><input value="<?php echo $player->agility ?>" type="number" class="form-control" name="player[<?php echo $player->player_id ?>][agility]" required /></td>
                        <td><input value="<?php echo $player->health ?>" type="number" class="form-control" name="player[<?php echo $player->player_id ?>][health]" required /></td>
                        <td>
                            <button type="button" data-item="<?php echo $player->player_id ?>" class="btn btn-default">Update</button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </table>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Weapons</h3>
        </div>
        <div class="panel-body">
            <form id="form-weapon">
                <table class="table" id="available-weapons">
                    <tr>
                        <th>#</th><th>Name</th><th>Strike Force</th><th>Defense</th><th>Damage</th><th></th>
                    </tr>
                    <?php foreach($weapons as $weapon): ?>
                        <tr>
                            <td><?php echo $weapon->weapon_id ?></td>
                            <td><input value="<?php echo $weapon->weapon_name ?>" type="text" class="form-control" name="weapon[<?php echo $weapon->weapon_id ?>][name]" /></td>
                            <td><input value="<?php echo $weapon->strike_force ?>" type="number" class="form-control" name="weapon[<?php echo $weapon->weapon_id ?>][strike_force]" /></td>
                            <td><input value="<?php echo $weapon->defense ?>" type="number" class="form-control" name="weapon[<?php echo $weapon->weapon_id ?>][defense]" /></td>
                            <td><input value="<?php echo $weapon->damage ?>" type="text" class="form-control" name="weapon[<?php echo $weapon->weapon_id ?>][damage]" /></td>
                            <td>
                                <button type="button" data-item="<?php echo $weapon->weapon_id ?>" class="btn btn-default">Update</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </form>
        </div>
    </div>
</div>