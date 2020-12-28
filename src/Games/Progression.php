<?php

namespace Php\Project\Lvl1\Games\Progression;

function play(array $gameConfig): array
{
    $length = mt_rand($gameConfig['minProgressionLength'], $gameConfig['maxProgressionLength']);
    $increment = mt_rand($gameConfig['minIncrement'], $gameConfig['maxIncrement']);
    $firstMember = mt_rand($gameConfig['minfirstMember'], $gameConfig['maxfirstMember']);
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
