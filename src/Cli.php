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

function selectGame(array $games): string
{
    line();
    $selectedIndex = menu($games, null, 'Choose a game (input a number)');
    return $games[$selectedIndex];
}

function outputDescription(string $description): void
{
    line("%s", $description);
}

function outputResultMessage(bool $success, string $correctAnswer, string $answer, string $name): void
{
    if ($success) {
        line("Congratulations, %s!", $name);
    } else {
        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $correctAnswer);
        line("Let's try again, %s!", $name);
    }
}

function askQuestion(string $question): string
{
    line("Question: %s", $question);
    return strtolower(trim(prompt('Your answer')));
}

function outputSuccessMessage(): void
{
    line('Correct!');
}
