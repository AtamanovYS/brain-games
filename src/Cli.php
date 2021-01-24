<?php

namespace PhpProjectLvl1\Cli;

use function cli\{line,
                  prompt,
                  menu,
                 };

function greet(): string
{
    line('Welcome to the Brain Game!');
    $name = ucfirst(trim(prompt('May I have your name?')));
    line("Hello, %s!", $name);
    return $name;
}

function selectGame(array $games): string
{
    line();
    $selectedIndex = menu($games, null, 'Choose a game (input a number)');
    return $games[$selectedIndex];
}

function ask(string $question): string
{
    return strtolower(trim(prompt($question)));
}
