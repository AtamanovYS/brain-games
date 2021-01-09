<?php

namespace PhpProjectLvl1\Engine;

use function PhpProjectLvl1\Cli\{greet,
                                 outputDescription,
                                 askQuestion,
                                 outputCorrectResult,
                                 outputSuccessMessage, outputFailureMessage,
                                 congratulate,
                                 selectGame,
                                };

const ROUNDS_COUNT = 3;
const GAMES_FILES_DIRECTORY = __DIR__ . '/Games';

function run(?string $game = null): void
{
    $name = greet();
    if ($game === null) {
        $games = getGamesName();
        $game = selectGame($games);
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
    // Поэтому привожу, чтобы предупреждения не было. Но в каких случаях возвращается false, не нашёл
    $gamesFilesNames = array_values((array) preg_grep('/^([^.])/', $filesInGamesDirectory));
    return array_map(fn($gameFileName) => str_replace('.php', '', $gameFileName), $gamesFilesNames);
}

function playGame(string $game, string $name): void
{
    $prevNameSpace = getPrevNamespace();
    $gameNamespace = "{$prevNameSpace}\\Games\\{$game}\\";

    $play = "{$gameNamespace}play";
    if (!function_exists($play)) {
        throw new \Exception("Unknown function {$play}()");
    }

    outputDescription(constant("{$gameNamespace}DESCRIPTION"));
    for ($i = 0; $i < ROUNDS_COUNT; ++$i) {
        $result = $play();
        $answer = askQuestion($result['question']);
        $isCorrect = $answer === (string) $result['correctAnswer'];
        if (!$isCorrect) {
            outputCorrectResult($result['correctAnswer'], $answer);
            outputFailureMessage($name);
            return;
        }
        outputSuccessMessage();
    }

    congratulate($name);
}

function getPrevNamespace(): string
{
    $partsNamespace = explode("\\", __NAMESPACE__);
    array_pop($partsNamespace);
    return implode("\\", $partsNamespace);
}
