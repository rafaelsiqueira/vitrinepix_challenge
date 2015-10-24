<?php

class Player extends Custom_Model {

    private $health;
    private $strength;
    private $agility;

    private $weapon;

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

    public function isHealthy() {
        return $this->getHealth() > 0;
    }

    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param mixed $health
     */
    public function setHealth($health)
    {
        $this->health = $health;
    }

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param mixed $strength
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    /**
     * @return mixed
     */
    public function getAgility()
    {
        return $this->agility;
    }

    /**
     * @param mixed $agility
     */
    public function setAgility($agility)
    {
        $this->agility = $agility;
    }

    /**
     * @return Weapon
     */
    public function getWeapon()
    {
        return $this->weapon;
    }

    /**
     * @param mixed $weapon
     */
    public function setWeapon($weapon)
    {
        $this->weapon = $weapon;
    }

    public function defense()
    {
        return Dice::nextStatic(range(1, 20)) + $this->getAgility() + $this->getWeapon()->getDefense();
    }

    public function attack(Player $defensor)
    {
        $dice = Dice::nextStatic(range(1, 20));
        $attack = $dice + $this->getAgility() + $this->getWeapon()->getStrikeForce();

        return $attack > $defensor->defense();
    }

    public function makeDamage(Weapon $weapon)
    {
        $damage = Dice::nextStatic($weapon->getDamageRange()) + $weapon->getStrikeForce();
        $health = $this->getHealth() - $damage;
        $this->setHealth($health);
    }
}