<?php

namespace Php\Project\Lvl1;

use function cli\line;
use function cli\prompt;

function playEvenGame()
{
    define('NUMBER_OF_STEPS', 3);
    define('MIN_NUMBER', 0);
    define('MAX_NUMBER', 100);
    $name = greet();
    line('Answer "yes" if the number is even, otherwise answer "no".');
    for ($i = 0; $i < NUMBER_OF_STEPS; ++$i) {
        $number = mt_rand(MIN_NUMBER, MAX_NUMBER);
        $numberIsEven = $number % 2 === 0;
        $correctAnswer = $numberIsEven ? 'yes' : 'no';
        line("Question: %d", $number);
        $answer = strtolower(trim(prompt('Your answer')));
        if ($answer !== $correctAnswer) {
            line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $correctAnswer);
            line("Let's try again, %s!", $name);
            return false;
        } else {
            line('Correct!');
        }
    }
    line("Congratulations, %s!", $name);
    return true;
}
