<?php

namespace PhpProjectLvl1\Engine;

use function PhpProjectLvl1\Cli\{greet, outputDescription, askQuestion, showResult, congrat};

const ROUNDS_COUNT = 3;

function playGame(string $game): void
{
    $name = greet();
    $prefix = "PhpProjectLvl1\\Games\\{$game}\\";
    $getConfig = "{$prefix}getConfig";
    if (function_exists($getConfig) && is_callable($getConfig)) {
        $config = $getConfig();
    } else {
        throw new \Exception("Unknown function {$getConfig}()");
    }
    outputDescription($config['description']);
    for ($i = 0; $i < ROUNDS_COUNT; ++$i) {
        $play = "{$prefix}play";
        if (function_exists($play) && is_callable($play)) {
            $result = $play($config);
        } else {
            throw new \Exception("Unknown function {$play}()");
        }
        $answer = askQuestion($result['question']);
        $isCorrect = $answer === (string) $result['correctAnswer'];
        showResult($result['correctAnswer'], $answer, $isCorrect, $name);
        if (!$isCorrect) {
            return;
        }
    }
    congrat($name);
}
