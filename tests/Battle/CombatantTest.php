<?php

namespace Symm;

class CombatantTest extends \PHPUnit_Framework_TestCase
{

    private function getCombatant()
    {
        return new Battle\Combatant\Swordsman('Bob');
    }

    public function testCreateACharacterOfEachType()
    {
        $swordsman = new Battle\Combatant\Swordsman('Swordsman');
        $this->assertInstanceOf('Symm\Battle\Combatant\Swordsman', $swordsman);
        $brute = new Battle\Combatant\Brute('Brute');
        $this->assertInstanceOf('Symm\Battle\Combatant\Brute', $brute);
        $grappler = new Battle\Combatant\Grappler('Grappler');
        $this->assertInstanceOf('Symm\Battle\Combatant\Grappler', $grappler);
    }

    public function testTheCharactersNameIsSet()
    {
        $swordsman = new Battle\Combatant\Swordsman('Swordsman');
        $this->assertEquals('Swordsman', $swordsman->getName());
    }

    public function testNameCannotBeNull()
    {
        $this->setExpectedException('LengthException');
        $swordsman = new Battle\Combatant\Swordsman('Swordsman');
        $swordsman->setName(null);
    }

    public function testNameMustBeAString()
    {
        $this->setExpectedException('InvalidArgumentException');
        $swordsman = new Battle\Combatant\Swordsman('Swordsman');
        $swordsman->setName(123456);
    }

    public function testNameCannotBeLongerThanThirtyCharacters()
    {
        $this->setExpectedException('LengthException');
        $swordsman = new Battle\Combatant\Swordsman('Swordsman');
        $swordsman->setName('A Long name that will not pass the validation check. Words and such');
    }

    public function testHealthMustBeAnInteger()
    {
        $swordsman = new Battle\Combatant\Swordsman('Swordsman');
        $this->setExpectedException('InvalidArgumentException');
        $swordsman->setHealth('foo');

    }

    public function testStrengthMustBeAnInteger()
    {
        $swordsman = new Battle\Combatant\Swordsman('Swordsman');
        $this->setExpectedException('InvalidArgumentException');
        $swordsman->setStrength('bar');
    }

    public function testDefenseMustBeAnInteger()
    {
        $swordsman = new Battle\Combatant\Swordsman('Swordsman');
        $this->setExpectedException('InvalidArgumentException');
        $swordsman->setDefense('bar');
    }

    public function testSpeedMustBeAnInteger()
    {
        $swordsman = new Battle\Combatant\Swordsman('Swordsman');
        $this->setExpectedException('InvalidArgumentException');
        $swordsman->setSpeed('bar');
    }

    public function testLuckMustBeADecimal()
    {
        $swordsman = new Battle\Combatant\Swordsman('Swordsman');
        $this->setExpectedException('InvalidArgumentException');

        $swordsman->setLuck('test');
    }

    public function testCharacterPropertiesAreGenerated()
    {
        $swordsman = new Battle\Combatant\Swordsman('Swordsman');
        $this->assertNotNull($swordsman->getDefense());
        $this->assertNotNull($swordsman->getHealth());
        $this->assertNotNull($swordsman->getLuck());
        $this->assertNotNull($swordsman->getName());
        $this->assertNotNull($swordsman->getSpeed());
        $this->assertNotNull($swordsman->getStrength());
    }


}
