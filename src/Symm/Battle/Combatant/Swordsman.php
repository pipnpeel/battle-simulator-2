<?php

namespace Symm\Battle\Combatant;

class Swordsman extends Combatant
{
    public function __construct($name)
    {
        $this->validation = array(
            'health'   => array('min' => 40,  'max' => 60),
            'strength' => array('min' => 60,  'max' => 70),
            'defense'  => array('min' => 20,  'max' => 30),
            'speed'    => array('min' => 90,  'max' => 100),
            'luck'     => array('min' => 0.3, 'max' => 0.5),
            'name'     => array('min' => 0,   'max' => 30),
        );

        parent::__construct($name);
    }
}
