<?php

require_once('vendor/autoload.php');
echo '
 ______         __   __   __
|   __ \.---.-.|  |_|  |_|  |.-----.
|   __ <|  _  ||   _|   _|  ||  -__|
|______/|___._||____|____|__||_____|
                                   ' .PHP_EOL;

echo 'Please enter the first Player\'s name: ';
$name = readline();
$playerOne = new Symm\Battle\Combatant\Brute($name);
echo 'Please enter the second Player\'s name: ';
$name = readline();
$playerTwo = new Symm\Battle\Combatant\Brute($name);

$game = new Symm\Battle\Game($playerOne, $playerTwo);

while (!$game->isFinished()) {
    echo $game->doRound() . PHP_EOL;
}

if (!$game->isDraw()) {
    $winner = $game->getWinner();
    echo "The winner is " . $winner->getName() . PHP_EOL;
} else {
    echo 'Game was a draw' . PHP_EOL;
}
