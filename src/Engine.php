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
    // preg_grep для исключения скрытых, служебных файлов
    // array_values для перенумерации массива по порядку
    $gamesFilesNames = array_values(preg_grep('/^([^.])/', scandir(__DIR__ . '/Games')));
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
    if (!function_exists($function) || !is_callable($function)) {
        throw new \Exception("Unknown function {$function}()");
    }
}
