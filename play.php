<?php

require_once('vendor/autoload.php');

$playerOne = new Symm\Battle\Combatant\Brute('Bob');
$playerTwo = new Symm\Battle\Combatant\Brute('Dave');

$game = new Symm\Battle\Game($playerOne, $playerTwo);

while (!$game->isFinished()) {
    echo $game->doRound() . PHP_EOL;
}

if (!$game->isDraw()) {
    $winner = $game->getWinner();
    echo "The winner is " . $winner->getName() . PHP_EOL;
} else {
    echo 'Game was a draw';
}
