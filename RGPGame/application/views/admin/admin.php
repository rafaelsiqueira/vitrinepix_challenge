<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->helper('form');

$weaponOptions = [ '' => 'Choose' ];
foreach($weapons as $weapon) {
    $weaponOptions[$weapon->id] = $weapon->name;
}

?>
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
                        <th>#</th><th>Name</th><th>Strength</th><th>Agility</th><th>Health</th><th>Weapon</th><th></th>
                    </tr>
                    <?php foreach($players as $player): ?>
                    <tr>
                        <td><?php echo $player->player_id ?></td>
                        <td><?php echo form_input(['name' => "player[$player->player_id][name]", 'type' => 'text', 'required' => 'required'], $player->player_name, 'class="form-control"') ?></td>
                        <td><?php echo form_input(['name' => "player[$player->player_id][strength]", 'type' => 'number', 'required' => 'required'], $player->strength, 'class="form-control"') ?></td>
                        <td><?php echo form_input(['name' => "player[$player->player_id][agility]", 'type' => 'number', 'required' => 'required'], $player->agility, 'class="form-control"') ?></td>
                        <td><?php echo form_input(['name' => "player[$player->player_id][health]", 'type' => 'number', 'required' => 'required'], $player->health, 'class="form-control"') ?></td>
                        <td><?php echo form_dropdown("player[<?php echo $player->player_id ?>][weapon]", $weaponOptions, $player->weapon_id, 'class="form-control"') ?></td>
                        <td>
                            <button type="button" data-action="update" data-item="<?php echo $player->player_id ?>" class="btn btn-default">Update</button>
                            <button type="button" data-action="delete" data-item="<?php echo $player->player_id ?>" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <?php endforeach ?>

                    <?php if(sizeof($players) < 2): ?>
                    <tr>
                        <td></td>
                        <td><?php echo form_input(['name' => "player[new][name]", 'type' => 'text', 'required' => 'required'], '', 'class="form-control"') ?></td>
                        <td><?php echo form_input(['name' => "player[new][strength]", 'type' => 'number', 'required' => 'required'], '', 'class="form-control"') ?></td>
                        <td><?php echo form_input(['name' => "player[new][agility]", 'type' => 'number', 'required' => 'required'], '', 'class="form-control"') ?></td>
                        <td><?php echo form_input(['name' => "player[new][health]", 'type' => 'number', 'required' => 'required'], '', 'class="form-control"') ?></td>
                        <td><?php echo form_dropdown("player[new][weapon_id]", $weaponOptions, '', 'class="form-control"') ?></td>
                        <td>
                            <button type="button" data-action="create" data-item="new" class="btn btn-primary">Create</button>
                        </td>
                    </tr>
                    <?php endif ?>
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
                            <td><?php echo $weapon->id ?></td>
                            <td><input value="<?php echo $weapon->name ?>" type="text" class="form-control" name="weapon[<?php echo $weapon->id ?>][name]" /></td>
                            <td><input value="<?php echo $weapon->strike_force ?>" type="number" class="form-control" name="weapon[<?php echo $weapon->id ?>][strike_force]" /></td>
                            <td><input value="<?php echo $weapon->defense ?>" type="number" class="form-control" name="weapon[<?php echo $weapon->id ?>][defense]" /></td>
                            <td><input value="<?php echo $weapon->damage ?>" type="text" class="form-control" name="weapon[<?php echo $weapon->id ?>][damage]" /></td>
                            <td>
                                <button type="button" data-item="<?php echo $weapon->id ?>" class="btn btn-default">Update</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </form>
        </div>
    </div>
</div>