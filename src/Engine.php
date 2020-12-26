<?php

namespace Php\Project\Lvl1;

use function cli\line;
use function cli\prompt;

const ROUNDS_COUNT = 3;

function playGame($name, $selectedGame)
{
    $gameConfig = getGameConfig($selectedGame);
    line($gameConfig['description']);
    for ($i = 0; $i < ROUNDS_COUNT; ++$i) {
        switch ($selectedGame) {
            case 'EvenGame':
                $result = Games\playEvenGame($gameConfig);
                break;
            case 'Calculator':
                $result = Games\playCalcGame($gameConfig);
                break;
        }
        line("Question: %s", $result['question']);
        $answer = strtolower(trim(prompt('Your answer')));
        if ($answer !== $result['correctAnswer']) {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $result['correctAnswer']);
            line("Let's try again, %s!", $name);
            return false;
        } else {
            line('Correct!');
        }
    }
    line("Congratulations, %s!", $name);
    return true;
}

function getGames()
{
    $games = [
        'EvenGame' => 'Parity check',
        'Calculator' => 'Calculator'
        ];
    return $games;
}

function getGameConfig($game)
{
    $config = [];
    switch ($game) {
        case 'EvenGame':
            $config['minNumber'] = 0;
            $config['maxNumber'] = 100;
            $config['description'] = 'Answer "yes" if the number is even, otherwise answer "no".';
            return $config;
        case 'Calculator':
            $config['firstMinNumber'] = 0;
            $config['firstMaxNumber'] = 100;
            $config['secondMinNumber'] = 0;
            $config['secondMaxNumber'] = 100;
            $config['description'] = 'What is the result of the expression?';
            return $config;
    }
}