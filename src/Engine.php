<?php

namespace PhpProjectLvl1\Engine;

use function PhpProjectLvl1\Cli\{greet,
                                 outputDescription,
                                 askQuestion,
                                 showResult,
                                 congrat,
                                 selectGameInMenu,
                                };

const ROUNDS_COUNT = 3;
const GAMES_FILES_DIRECTORY = __DIR__ . '/Games';

function run(?string $game = null): void
{
    $name = greet();
    if ($game === null) {
        $games = getGamesName();
        $game = selectGameInMenu($games);
    }
    playGame($game, $name);
}

function getGamesName(): array
{
    $filesInGamesDirectory = scandir(GAMES_FILES_DIRECTORY);
    if ($filesInGamesDirectory === false) {
        throw new \Exception('Unknown games files directory ' . GAMES_FILES_DIRECTORY);
    }

    // (array) preg_grep написал, так как phpstan ругается, что возвращаемый тип preg_grep равен array|false
    // С приведением не ругается. Но в каких случаях возвращается false не нашёл нигде и сам не смог получить
    $gamesFilesNames = array_values((array) preg_grep('/^([^.])/', $filesInGamesDirectory));
    return array_map(fn($gameFileName) => str_replace('.php', '', $gameFileName), $gamesFilesNames);
}

function playGame(string $game, string $name): void
{
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

function checkExistance(string &$function): void
{
    if (!function_exists($function)) {
        throw new \Exception("Unknown function {$function}()");
    }
}
