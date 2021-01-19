<?php

namespace PhpProjectLvl1\Games\Even;

const DESCRIPTION = 'Answer "yes" if the number is even, otherwise answer "no".';

function play(): void
{
    \PhpProjectLvl1\Engine\play(__NAMESPACE__);
}

function getData(): array
{
    $config = getConfig();
    $number = mt_rand($config['minNumber'], $config['maxNumber']);
    $correctAnswer = $number % 2 === 0 ? 'yes' : 'no';

    return [
        'question'      => $number,
        'correctAnswer' => $correctAnswer,
    ];
}

function getConfig(): array
{
    return [
        'minNumber'     => 0,
        'maxNumber'     => 100,
    ];
}
