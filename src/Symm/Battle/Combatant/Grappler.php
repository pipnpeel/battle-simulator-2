<?php

namespace Symm\Battle\Combatant;

class Grappler extends Combatant
{
    public function __construct($name)
    {
        $this->validation = array(
            'health'   => array('min' => 60,  'max' => 100),
            'strength' => array('min' => 75,  'max' => 80),
            'defense'  => array('min' => 35,  'max' => 40),
            'speed'    => array('min' => 60,  'max' => 80),
            'luck'     => array('min' => 0.3, 'max' => 0.4),
            'name'     => array('min' => 0,   'max' => 30),
        );

        parent::__construct($name);
    }
}
