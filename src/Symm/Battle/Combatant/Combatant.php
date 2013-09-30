<?php

namespace Symm\Battle\Combatant;

abstract class Combatant
{

    private $name;
    private $health;
    private $strength;
    private $defense;
    private $speed;
    private $luck;
    private $stunned;

    public function __construct($name)
    {
        $this->setName($name);
        $this->generateProperties();
        $this->stunned = false;
    }

    public function getType()
    {
        $className = get_class($this);
        // remove the namespace
        return substr($className, strrpos($className, '\\') + 1);
    }

    public function isDead()
    {
        return $this->health <= 0;
    }

    private function generateProperties()
    {
        // @todo: remove hardcoded property list
        $properties = array('health', 'strength', 'defense', 'speed');
        foreach ($properties as $property) {
            $setter = "set" . ucfirst($property);
            $this->$setter(mt_rand($this->validation[$property]['min'], $this->validation[$property]['max']));
        }

        $luck = (mt_rand($this->validation['luck']['min'] * 1000, $this->validation['luck']['max'] * 1000) / 1000);
        $luck = number_format($luck, 2);
        $this->setLuck($luck);
    }

    public function stun()
    {
        $this->stunned = true;
    }

    public function isStunned()
    {
        return $this->stunned;
    }

    public function attack(Combatant $defender)
    {

        if ($this->isStunned()) {
            $this->stunned = false;
            return false;
        }

        //@todo: handle special skills

        // If the defender is lucky enough we will miss
        $luck = $defender->getLuck();
        $willMiss = mt_rand(1, 100) > ($luck * 100) ? false : true;
        if ($willMiss == true) {
            return false;
        }

        $damage = $this->calculateDamage($defender);

        $defender->removeHealth($damage);

        return $damage;
    }

    private function calculateDamage(Combatant $defender)
    {
        $damage = $this->getStrength() - $defender->getDefense();

        if ($damage < 0) {
            $damage = 0;
        }

        return $damage;
    }

    public function setDefense($defense)
    {
        if (!is_integer($defense)) {
            throw new \InvalidArgumentException('Defense must be an integer');
        }

        $this->defense = $defense;
        return $this;
    }

    public function getDefense()
    {
        return $this->defense;
    }

    public function removeHealth($damage)
    {
        $this->health = $this->health - $damage;
    }

    public function setHealth($health)
    {
        if (!is_integer($health)) {
            throw new \InvalidArgumentException('Health must be an integer');
        }

        $this->health = $health;
        return $this;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function setLuck($luck)
    {
        $isDecimal = is_numeric($luck) && floor($luck) != $luck;

        if (!$isDecimal) {
            throw new \InvalidArgumentException('Luck must be a decimal');
        }

        $this->luck = $luck;
        return $this;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function setName($name)
    {
        if (empty($name)) {
            throw new \LengthException('Name cannot be empty');
        }

        if (!is_string($name)) {
            throw new \InvalidArgumentException('Name must be a string');
        }

        if (strlen($name) > 30) {
            throw new \LengthException('Name cannot be longer than 30 characters');
        }

        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSpeed($speed)
    {
        if (!is_integer($speed)) {
            throw new \InvalidArgumentException('Speed must be an integer');
        }

        $this->speed = $speed;
        return $this;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function setStrength($strength)
    {
        if (!is_integer($strength)) {
            throw new \InvalidArgumentException('Strength must be an integer');
        }

        $this->strength = $strength;
        return $this;
    }

    public function getStrength()
    {
        return $this->strength;
    }

}