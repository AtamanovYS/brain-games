<?php

namespace Php\Project\Lvl1\Engine;

use function cli\line;
use function cli\prompt;

const ROUNDS_COUNT = 3;

function playGame(string $name, string $game): bool
{
    $gameConfig = getGameConfig($game);
    line($gameConfig['description']);
    for ($i = 0; $i < ROUNDS_COUNT; ++$i) {
        switch ($game) {
            case 'evenGame':
                $result = \Php\Project\Lvl1\Games\Even\play($gameConfig);
                break;
            case 'calculator':
                $result = \Php\Project\Lvl1\Games\Calc\play($gameConfig);
                break;
            case 'gcd':
                $result = \Php\Project\Lvl1\Games\Gcd\play($gameConfig);
                break;
            case 'progression':
                $result = \Php\Project\Lvl1\Games\Progression\play($gameConfig);
                break;
            case 'prime':
                $result = \Php\Project\Lvl1\Games\Prime\play($gameConfig);
                break;
            default:
                $result = getEmptyResult();
        }
        line("Question: %s", $result['question']);
        $answer = strtolower(trim(prompt('Your answer')));
        if ($answer !== (string) $result['correctAnswer']) {
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

function getEmptyResult(): array
{
    $result = [
    'question'      => '',
    'correctAnswer' => null];
    return $result;
}

function getGameConfig(string $game): array
{
    $config = [];
    switch ($game) {
        case 'evenGame':
            $config['minNumber'] = 0;
            $config['maxNumber'] = 100;
            $config['description'] = 'Answer "yes" if the number is even, otherwise answer "no".';
            break;
        case 'calculator':
            $config['firstMinNumber'] = 0;
            $config['firstMaxNumber'] = 100;
            $config['secondMinNumber'] = 0;
            $config['secondMaxNumber'] = 100;
            $config['description'] = 'What is the result of the expression?';
            break;
        case 'gcd':
            $config['firstMinNumber'] = 1;
            $config['firstMaxNumber'] = 100;
            $config['secondMinNumber'] = 1;
            $config['secondMaxNumber'] = 100;
            $config['description'] = 'Find the greatest common divisor of given numbers.';
            break;
        case 'progression':
            $config['minProgressionLength'] = 5;
            $config['maxProgressionLength'] = 15;
            $config['minIncrement'] = 1;
            $config['maxIncrement'] = 20;
            $config['minfirstMember'] = 0;
            $config['maxfirstMember'] = 15;
            $config['description'] = 'What number is missing in the progression?';
            break;
        case 'prime':
            $config['minNumber'] = 0;
            $config['maxNumber'] = 100;
            $config['description'] = 'Answer "yes" if given number is prime. Otherwise answer "no".';
            break;
        default:
            $config['description'] = '';
    }
    return $config;
}
