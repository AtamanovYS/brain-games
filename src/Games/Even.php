<?php

namespace PhpProjectLvl1\Games\Even;

const DESCRIPTION = 'Answer "yes" if the number is even, otherwise answer "no".';

function play(): array
{
    $config = getConfig();
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
    return [
        'minNumber'     => 0,
        'maxNumber'     => 100,
    ];
}
