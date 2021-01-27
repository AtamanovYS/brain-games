<?php

namespace PhpProjectLvl1\Engine;

use function cli\{line, prompt, menu};

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

function selectGame(array $games): string
{
    line();
    $selectedIndex = menu($games, null, 'Choose a game (input a number)');
    return $games[$selectedIndex];
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
    line($description);

    if (!function_exists($getData) || !is_callable($getData)) {
        throw new \Exception("Unknown function {$getData}()");
    }

    $answer = '';
    $result = [];
    $success = true;

    for ($i = 0; $i < ROUNDS_COUNT; ++$i) {
        $result = $getData();
        line("Question: %s", $result['question']);
        $answer = ask('Your answer');
        $isCorrect = $answer === $result['correctAnswer'];
        if (!$isCorrect) {
            $success = false;
            break;
        }
        line('Correct!');
    }

    if ($success) {
        line("Congratulations, %s!", $name);
    } else {
        line("'%s' is wrong answer ;(. Correct answer was '%s'.", $answer, $result['correctAnswer']);
        line("Let's try again, %s!", $name);
    }
}

function greet(): string
{
    line('Welcome to the Brain Game!');
    $name = ucfirst(trim(prompt('May I have your name?')));
    line("Hello, %s!", $name);
    return $name;
}

function ask(string $question): string
{
    return strtolower(trim(prompt($question)));
}

function getPrevNamespace(): string
{
    $partsNamespace = explode("\\", __NAMESPACE__);
    array_pop($partsNamespace);
    return implode("\\", $partsNamespace);
}
