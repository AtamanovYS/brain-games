<?php

namespace PhpProjectLvl1\Games\Prime;

const DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';

function play(): void
{
    \PhpProjectLvl1\Engine\play(__NAMESPACE__);
}

function getData(): array
{
    $config = getConfig();
    $number = mt_rand($config['minNumber'], $config['maxNumber']);
    $correctAnswer = isPrime($number) ? 'yes' : 'no';

    return [
        'question'      => $number,
        'correctAnswer' => $correctAnswer,
    ];
}

function isPrime(int $number): bool
{
    if ($number <= 1) {
        return false;
    }
    for ($i = 2, $halfNumber = intdiv($number, 2); $i <= $halfNumber; ++$i) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}

function getConfig(): array
{
    return [
        'minNumber'     => 0,
        'maxNumber'     => 100,
    ];
}
