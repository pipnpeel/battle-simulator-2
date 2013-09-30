<?php

namespace Symm\Battle;

class Game
{

    private $maxRounds;
    private $currentRound = 0;
    private $attacker;
    private $defender;
    private $roundLog;

    private $gameOver = false;
    private $winner;

    public function __construct($playerOne, $playerTwo, $maxRounds = 30)
    {
        $this->maxRounds = $maxRounds;
        $this->decideAttackerAndDefender($playerOne, $playerTwo);
    }

    public function doRound()
    {
        if ($this->gameOver) {
            return false;
        }

        $damage = $this->attacker->attack($this->defender);
        if (!$damage) {
            $this->roundLog[] = $this->attacker->getName() . ' Missed!';
        } else {
            $this->roundLog[] = $this->attacker->getName() . ' Hit ' . $this->defender->getName()
                . ' for ' . $damage . ' damage';
        }

        $this->switchPlayers();
        $this->currentRound++;

        if ($this->defender->isDead()) {
            $this->gameOver = true;
            $this->winner = $this->attacker;
        };

        if ($this->currentRound == $this->maxRounds) {
            $this->gameOver = true;
            $this->winner = null;
        }

        $log = end($this->roundLog);
        reset($this->roundLog);

        return $log;
    }

    public function isFinished()
    {
        return $this->gameOver;
    }

    public function getWinner()
    {
        return $this->winner;
    }

    public function isDraw()
    {
        return ($this->winner == null) ? true : false;
    }

    public function getRoundLog()
    {
        return $this->roundLog;
    }

    /**
     * Attacker becomes defender
     */
    private function switchPlayers()
    {
        $origAttacker   = $this->attacker;
        $this->attacker = $this->defender;
        $this->defender = $origAttacker;
    }

    /**
     * Determine which player should go first
     * If two players have the same speed the one with the lower defense goes first
     * Otherwise Fastest player goes first
     * @todo Refactor
     */
    private function decideAttackerAndDefender($playerOne, $playerTwo)
    {
        if ($playerOne->getSpeed() == $playerTwo->getSpeed()) {
            if ($playerOne->getDefense() < $playerTwo->getDefense()) {
                $this->attacker = $playerOne;
                $this->defender = $playerTwo;
            } else {
                $this->attacker = $playerTwo;
                $this->defender = $playerOne;
            }
        } else {
            if ($playerOne->getSpeed() > $playerTwo->getSpeed()) {
                $this->attacker = $playerOne;
                $this->defender = $playerTwo;
            } else {
                $this->attacker = $playerTwo;
                $this->defender = $playerOne;
            }
        }
    }
}
