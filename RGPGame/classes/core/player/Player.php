<?php
namespace core\player;

use core\weapon\Weapon;
use util\Dice;

abstract class Player {

    private $health;
    private $strength;
    private $velocity;

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
    public function getVelocity()
    {
        return $this->velocity;
    }

    /**
     * @param mixed $velocity
     */
    public function setVelocity($velocity)
    {
        $this->velocity = $velocity;
    }

    /**
     * @return Weapon
     */
    public function getWeapon()
    {
        return $this->weapon;
    }

    /**
     * @param For $weapon
     */
    public function setWeapon(Weapon $weapon)
    {
        $this->weapon = $weapon;
    }

    public function defense()
    {
    }

    public function attack(Player $defensor)
    {
    }

    public function makeDamage(Weapon $weapon)
    {
    }
}