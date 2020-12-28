<?php

namespace Php\Project\Lvl1\Games\Prime;

function play($gameConfig)
{
    $number = mt_rand($gameConfig['minNumber'], $gameConfig['maxNumber']);
    $numberIsPrime = isPrime($number);
    $correctAnswer = $numberIsPrime ? 'yes' : 'no';

    $result = [
    'question'      => $number,
    'correctAnswer' => $correctAnswer];
    return $result;
}

function isPrime(int $number): bool
{
    for ($i = 2, $halfNumber = intdiv($number, 2); $i < $halfNumber; ++$i) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}
