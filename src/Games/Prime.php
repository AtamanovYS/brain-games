<?php

namespace Php\Project\Lvl1\Games\Prime;

function play($gameConfig)
{
    $number = mt_rand($gameConfig['minNumber'], $gameConfig['maxNumber']);
    $numberIsPrime = gmp_prob_prime($number) === 2;
    $correctAnswer = $numberIsPrime ? 'yes' : 'no';

    $result = [
    'question'      => $number,
    'correctAnswer' => $correctAnswer];
    return $result;
}
