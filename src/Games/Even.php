<?php

namespace PhpProjectLvl1\Games\Even;

function play(array &$config): array
{
    $number = mt_rand($config['minNumber'], $config['maxNumber']);
    $numberIsEven = $number % 2 === 0;
    $correctAnswer = $numberIsEven ? 'yes' : 'no';

    $result = [
    'question'      => $number,
    'correctAnswer' => $correctAnswer,
    ];
    return $result;
}

function getConfig(): array
{
    $config = [
    'minNumber'     => 0,
    'maxNumber'     => 100,
    'description'   => 'Answer "yes" if the number is even, otherwise answer "no".',
    ];
    return $config;
}
