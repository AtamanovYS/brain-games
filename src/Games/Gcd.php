<?php

namespace Php\Project\Lvl1\Games\Gcd;

function play(array $gameConfig): array
{
    $firstNumber = mt_rand($gameConfig['firstMinNumber'], $gameConfig['firstMaxNumber']);
    $secondNumber = mt_rand($gameConfig['secondMinNumber'], $gameConfig['secondMaxNumber']);
    $gcd = gcd($firstNumber, $secondNumber);

    $result = [
    'question'      => "{$firstNumber} {$secondNumber}",
    'correctAnswer' => $gcd];
    return $result;
}

// Алгоритм Евклида для вычисления НОД
function gcd(int $number1, int $number2): int
{
    $a = max($number1, $number2);
    $b = min($number1, $number2);
    $r = $a % $b;
    return $r === 0 ? $b : gcd($r, $b);
}
