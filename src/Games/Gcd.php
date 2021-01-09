<?php

namespace PhpProjectLvl1\Games\Gcd;

const DESCRIPTION = 'Find the greatest common divisor of given numbers.';

function play(): array
{
    $config = getConfig();
    $firstNumber = mt_rand($config['firstMinNumber'], $config['firstMaxNumber']);
    $secondNumber = mt_rand($config['secondMinNumber'], $config['secondMaxNumber']);
    $gcd = gcd($firstNumber, $secondNumber);

    $result = [
    'question'      => "{$firstNumber} {$secondNumber}",
    'correctAnswer' => $gcd,
    ];
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

function getConfig(): array
{
    return [
        'firstMinNumber'    => 1,
        'firstMaxNumber'    => 100,
        'secondMinNumber'   => 1,
        'secondMaxNumber'   => 100,
    ];
}
