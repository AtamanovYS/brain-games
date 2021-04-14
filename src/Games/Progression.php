<?php

namespace BrainGames\Games\Progression;

const DESCRIPTION = 'What number is missing in the progression?';

function play(): void
{
    \BrainGames\Engine\play(DESCRIPTION, __NAMESPACE__ . '\\getData');
}

function getData(): array
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

    return [
        'question'      => $progressionStr,
        'correctAnswer' => (string) $hiddenElement,
    ];
}

function evaluateArithmeticProgression(int $firstMember, int $length, int $increment): array
{
    $progression = [];
    for ($i = 0; $i < $length; ++$i) {
        // The formula for the nth term of an arithmetic progression
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
