<?php
namespace core\models\player;

use core\models\weapon\Weapon;
use util\Dice;

abstract class Player {

    private $health;
    private $strength;
    private $agility;

    /**
     * @var For the challenge propose, i'm considering 1:1 relation between Player/Weapon
     */
    private $weapon;

    public function isHealthy() {
        return $this->getHealth() > 0;
    }

    public function getHealth()
    {
        return $this->health;
    }

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
        $this->agility = agility;
    }

    /**
     * @return Weapon
     */
    public function getWeapon()
    {
        return $this->weapon;
    }

    /**
     * @param Weapon $weapon
     */
    public function setWeapon(Weapon $weapon)
    {
        $this->weapon = $weapon;
    }

    public function defense()
    {
        return Dice::next(range(1, 20)) + $this->getAgility() + $this->getWeapon()->getDefense();
    }

    public function attack(Player $defensor)
    {
        $dice = Dice::next(range(1, 20));
        $attack = $dice + $this->getAgility() + $this->getWeapon()->getStrikeForce();

        return $attack > $defensor->defense();
    }

    public function makeDamage(Weapon $weapon)
    {
        $damage = Dice::next($weapon->getDamage()) + $weapon->getStrikeForce();
        $health = $this->getHealth() - $damage;
        $this->setHealth($health);
    }
}