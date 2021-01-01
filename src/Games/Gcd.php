<?php

namespace PhpProjectLvl1\Games\Gcd;

function play(array $config): array
{
    $firstNumber = mt_rand($config['firstMinNumber'], $config['firstMaxNumber']);
    $secondNumber = mt_rand($config['secondMinNumber'], $config['secondMaxNumber']);
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

function getConfig(): array
{
    $config = [];
    $config['firstMinNumber'] = 1;
    $config['firstMaxNumber'] = 100;
    $config['secondMinNumber'] = 1;
    $config['secondMaxNumber'] = 100;
    $config['description'] = 'Find the greatest common divisor of given numbers.';
    return $config;
}
