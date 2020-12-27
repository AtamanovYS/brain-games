<?php

namespace Php\Project\Lvl1\Cli;

use function cli\line;
use function cli\prompt;
use function cli\menu;
use function cli\confirm;
use function Php\Project\Lvl1\Engine\playGame;
use function Php\Project\Lvl1\Engine\getGames;

function run()
{
    $name = greet();
    $games = getGames();

    do {
        $selectedGame = menu($games, null, 'Select the game');
        playGame($name, $selectedGame);
    } while (confirm('Continue'));
}

function greet()
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!\n", $name);
    return $name;
}
