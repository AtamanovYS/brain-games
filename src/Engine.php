<?php

namespace PhpProjectLvl1\Engine;

use function PhpProjectLvl1\Cli\{greet, outputDescription, askQuestion, showResult, congrat};

const ROUNDS_COUNT = 3;

function playGame(string $game): void
{
    $name = greet();
    $prefix = "PhpProjectLvl1\\Games\\{$game}\\";

    $getConfig = "{$prefix}getConfig";
    checkExistance($getConfig);
    $config = $getConfig();

    $play = "{$prefix}play";
    checkExistance($play);

    outputDescription($config['description']);
    for ($i = 0; $i < ROUNDS_COUNT; ++$i) {
        $result = $play($config);
        $answer = askQuestion($result['question']);
        $isCorrect = $answer === (string) $result['correctAnswer'];
        showResult($result['correctAnswer'], $answer, $isCorrect, $name);
        if (!$isCorrect) {
            return;
        }
    }

    congrat($name);
}

function checkExistance(string $function): void
{
    if (!function_exists($function)) {
        throw new \Exception("Unknown function {$function}()");
    }
}
