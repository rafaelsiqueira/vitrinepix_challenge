<?php
namespace core\weapon;

class Weapon {

    private $strikForce;
    private $defense;
    private $damage;

    /**
     * @return mixed
     */
    public function getStrikForce()
    {
        return $this->strikForce;
    }

    /**
     * @param mixed $strikForce
     */
    public function setStrikForce($strikForce)
    {
        $this->strikForce = $strikForce;
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
}