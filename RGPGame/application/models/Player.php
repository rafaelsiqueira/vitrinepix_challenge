<?php

class Player extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function list_available_players() {

        $q  = 'SELECT DISTINCT '
            . '  p.id as player_id, p.name as player_name, p.health, p.strength, p.agility, '
            . '  w.id as weapon_id, w.name as weapon_name, w.strike_force, w.defense, w.damage '

            . 'FROM '
	        . '  player p '
            . '  INNER JOIN player_weapon wp ON wp.player_id = p.id '
            . '  INNER JOIN weapon w ON w.id = wp.weapon_id ';

        return $this->db->query($q)->result();

    }
}