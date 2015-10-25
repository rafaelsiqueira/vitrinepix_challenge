<?php

class Player extends Custom_Model {

    private $name;
    private $health;
    private $strength;
    private $agility;

    private $initiative_point;

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
            . '  LEFT JOIN player_weapon wp ON wp.player_id = p.id '
            . '  LEFT JOIN weapon w ON w.id = wp.weapon_id ';

        return $this->db->query($q)->result();

    }

    public function create($data) {
        $weapon = $data['weapon_id'];
        unset($data['weapon_id']);

        $player_id = parent::create($data);

        if($player_id > 0) {
            return $this->db->insert('player_weapon', [
                'player_id' => $player_id,
                'weapon_id' => $weapon
            ]);
        }

        return false;
    }

    public function delete($id) {
        parent::delete($id);
        return $this->db->delete('player_weapon', ['player_id' => $id]);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return mixed
     */
    public function getInitiativePoint()
    {
        return $this->initiative_point;
    }

    /**
     * @param mixed $initiative_point
     */
    public function setInitiativePoint($initiative_point)
    {
        $this->initiative_point = $initiative_point;
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

        $attack  = $dice + $this->getAgility() + $this->getWeapon()->getStrikeForce();
        $defense = $defensor->defense();

        return [
            'success' => ($attack > $defense),
            'attack_points' => $attack,
            'defense_points' => $defense
        ];
    }

    public function makeDamage(Weapon $weapon)
    {
        $damage = Dice::nextStatic($weapon->getDamageRange()) + $weapon->getStrikeForce();
        $health = $this->getHealth() - $damage;
        $this->setHealth($health);

        return [
            'damage' => $damage,
            'remaining_health' => $health
        ];
    }
}