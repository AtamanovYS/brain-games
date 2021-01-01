<?php

namespace PhpProjectLvl1\Games\Prime;

function play(array $config): array
{
    $number = mt_rand($config['minNumber'], $config['maxNumber']);
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

function getConfig(): array
{
    $config = [];
    $config['minNumber'] = 0;
    $config['maxNumber'] = 100;
    $config['description'] = 'Answer "yes" if given number is prime. Otherwise answer "no".';
    return $config;
}
