<?php

class Weapon extends Custom_Model {

    private $strikeForce;
    private $defense;
    private $damage;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getStrikeForce()
    {
        return $this->strikeForce;
    }

    public function setStrike_force($strikeForce) {
        $this->setStrikeForce($strikeForce);
    }

    /**
     * @param mixed $strikeForce
     */
    public function setStrikeForce($strikeForce)
    {
        $this->strikeForce = $strikeForce;
    }

    /**
     * @return mixed
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * @param mixed $defense
     */
    public function setDefense($defense)
    {
        $this->defense = $defense;
    }

    /**
     * @return mixed
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @param mixed $damage
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;
    }

    public function getDamageRange() {
        $range = explode('d', $this->getDamage());
        return range(min($range), max($range));
    }
}