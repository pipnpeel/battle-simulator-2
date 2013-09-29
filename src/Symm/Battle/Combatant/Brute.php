<?php

namespace Symm\Battle\Combatant;

class Brute extends Combatant
{
    public function __construct($name)
    {
        $this->validation = array(
            'health'   => array('min' => 90,  'max' => 100),
            'strength' => array('min' => 65,  'max' => 75),
            'defense'  => array('min' => 40,  'max' => 50),
            'speed'    => array('min' => 40,  'max' => 65),
            'luck'     => array('min' => 0.3, 'max' => 0.35),
            'name'     => array('min' => 0,   'max' => 30),
        );

        parent::__construct($name);
    }
}
