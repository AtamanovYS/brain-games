<?php

namespace PhpProjectLvl1\Cli;

use function cli\{line, prompt, menu};

function greet(): string
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    return $name;
}

function selectGameInMenu(array $games): string
{
    line();
    $selectedIndex = menu($games, null, 'Choose a game (input number)');
    return $games[$selectedIndex];
}

function outputDescription(string $description): void
{
    line("%s", $description);
}

function askQuestion(string $question): string
{
    line("Question: %s", $question);
    return strtolower(trim(prompt('Your answer')));
}

function congrat(string $name): void
{
    line("Congratulations, %s!", $name);
}

function showResult(string $correctAnswer, string $answer, bool $isCorrect, string $name): void
{
    if (!$isCorrect) {
        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $correctAnswer);
        line("Let's try again, %s!", $name);
    } else {
        line('Correct!');
    }
}
