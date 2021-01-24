<?php

namespace PhpProjectLvl1\Engine;

use function PhpProjectLvl1\Cli\{greet,
                                 selectGame,
                                 ask,
                                };
use function cli\{line as show};

const ROUNDS_COUNT = 3;
const GAMES_FILES_DIRECTORY = __DIR__ . '/Games';

function run(): void
{
    $games = getGamesName();
    $game = selectGame($games);
    $gameNamespace = getPrevNamespace() . "\\Games\\{$game}";
    $play = "{$gameNamespace}\\play";

    if (!function_exists($play) || !is_callable($play)) {
        throw new \Exception("Unknown function {$play}()");
    }

    $play();
}

function getGamesName(): array
{
    $filesInGamesDirectory = scandir(GAMES_FILES_DIRECTORY);
    if ($filesInGamesDirectory === false) {
        throw new \Exception('Unknown games files directory ' . GAMES_FILES_DIRECTORY);
    }

    $gamesFilesNames = array_values((array) preg_grep('/^([^.])/', $filesInGamesDirectory));
    return array_map(fn($gameFileName) => str_replace('.php', '', $gameFileName), $gamesFilesNames);
}

function play(string $description, string $getData): void
{
    $name = greet();
    show($description);

    if (!function_exists($getData) || !is_callable($getData)) {
        throw new \Exception("Unknown function {$getData}()");
    }

    $answer = '';
    $result = [];
    $success = true;

    for ($i = 0; $i < ROUNDS_COUNT; ++$i) {
        $result = $getData();
        show("Question: %s", $result['question']);
        $answer = ask('Your answer');
        $isCorrect = $answer === $result['correctAnswer'];
        if (!$isCorrect) {
            $success = false;
            break;
        }
        show('Correct!');
    }

    if ($success) {
        show("Congratulations, %s!", $name);
    } else {
        show("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $result['correctAnswer']);
        show("Let's try again, %s!", $name);
    }
}

function getPrevNamespace(): string
{
    $partsNamespace = explode("\\", __NAMESPACE__);
    array_pop($partsNamespace);
    return implode("\\", $partsNamespace);
}
