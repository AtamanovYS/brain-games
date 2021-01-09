<?php

namespace PhpProjectLvl1\Games\Progression;

const DESCRIPTION = 'What number is missing in the progression?';

function play(): array
{
    $config = getConfig();
    $length = mt_rand($config['minProgressionLength'], $config['maxProgressionLength']);
    $increment = mt_rand($config['minIncrement'], $config['maxIncrement']);
    $firstMember = mt_rand($config['minfirstMember'], $config['maxfirstMember']);
    $progression = [$firstMember];
    for ($i = 2; $i <= $length; ++$i) {
        $progression[] = $firstMember + $increment * ($i - 1);
    }
    $hiddenIndex = mt_rand(0, $length - 1);
    $hiddenElement = $progression[$hiddenIndex];
    $progression[$hiddenIndex] = '..';
    $progressionStr = implode(' ', $progression);

    $result = [
        'question'      => $progressionStr,
        'correctAnswer' => $hiddenElement,
    ];
    return $result;
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
