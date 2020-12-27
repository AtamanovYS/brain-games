<?php

namespace Php\Project\Lvl1\Games\GcdGame;

function playGcdGame($gameConfig)
{
    $firstNumber = mt_rand($gameConfig['firstMinNumber'], $gameConfig['firstMaxNumber']);
    $secondNumber = mt_rand($gameConfig['secondMinNumber'], $gameConfig['secondMaxNumber']);
    $gcd = (string) gmp_gcd($firstNumber, $secondNumber);

    $result = [
    'question'      => "{$firstNumber} {$secondNumber}",
    'correctAnswer' => $gcd];
    return $result;
}
