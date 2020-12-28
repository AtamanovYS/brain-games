<?php

namespace Php\Project\Lvl1\Cli;

use function cli\line;
use function cli\prompt;
use function Php\Project\Lvl1\Engine\playGame;

function run($game)
{
    $name = greet();
    playGame($name, $game);
}

function greet()
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!\n", $name);
    return $name;
}
