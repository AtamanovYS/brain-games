<?php

namespace Php\Project\Lvl1\Games\EvenGame;

function playEvenGame($gameConfig)
{
    $number = mt_rand($gameConfig['minNumber'], $gameConfig['maxNumber']);
    $numberIsEven = $number % 2 === 0;
    $correctAnswer = $numberIsEven ? 'yes' : 'no';

    $result = [
    'question'      => $number,
    'correctAnswer' => $correctAnswer];
    return $result;
}
