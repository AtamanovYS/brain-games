<?php

namespace PhpProjectLvl1\Games\Progression;

function play(array &$config): array
{
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
    'correctAnswer' => $hiddenElement];
    return $result;
}

function getConfig(): array
{
    $config = [];
    $config['minProgressionLength'] = 5;
    $config['maxProgressionLength'] = 15;
    $config['minIncrement'] = 1;
    $config['maxIncrement'] = 20;
    $config['minfirstMember'] = 0;
    $config['maxfirstMember'] = 15;
    $config['description'] = 'What number is missing in the progression?';
    return $config;
}
