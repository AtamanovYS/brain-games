<?php

namespace PhpProjectLvl1\Games\Progression;

const DESCRIPTION = 'What number is missing in the progression?';

function play(): array
{
    $config = getConfig();
    $length = mt_rand($config['minProgressionLength'], $config['maxProgressionLength']);
    $increment = mt_rand($config['minIncrement'], $config['maxIncrement']);
    $firstMember = mt_rand($config['minfirstMember'], $config['maxfirstMember']);

    $progression = evaluateArithmeticProgression($firstMember, $length, $increment);

    $hiddenIndex = array_rand($progression);
    $hiddenElement = $progression[$hiddenIndex];
    $progression[$hiddenIndex] = '..';
    $progressionStr = implode(' ', $progression);

    $result = [
        'question'      => $progressionStr,
        'correctAnswer' => $hiddenElement,
    ];
    return $result;
}

function evaluateArithmeticProgression(int $firstMember, int $length, int $increment): array
{
    $progression = [$firstMember];
    for ($i = 2; $i <= $length; ++$i) {
        // Формула n-го члена арифметической прогрессии
        $progression[] = $firstMember + $increment * ($i - 1);
    }
    return $progression;
}

function getConfig(): array
{
    return [
        'minProgressionLength'  => 5,
        'maxProgressionLength'  => 15,
        'minIncrement'          => 1,
        'maxIncrement'          => 20,
        'minfirstMember'        => 0,
        'maxfirstMember'        => 15,
    ];
}
