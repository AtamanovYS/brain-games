<?php

namespace PhpProjectLvl1\Engine;

use function PhpProjectLvl1\Cli\{greet,
                                 outputDescription,
                                 askQuestion,
                                 outputSuccessMessage,
                                 outputResultMessage,
                                 selectGame,
                                };

const ROUNDS_COUNT = 3;
const GAMES_FILES_DIRECTORY = __DIR__ . '/Games';

function run(): void
{
    $games = getGamesName();
    $game = selectGame($games);
    $gameNamespace = getPrevNamespace() . "\\Games\\{$game}";
    $play = "{$gameNamespace}\\play";

    // is_callable, чтобы phpstan не выдавал ошибку
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

    // (array) preg_grep написал, так как phpstan ругается, что возвращаемый тип preg_grep равен array|false
    // Поэтому привожу, чтобы предупреждения не было. Но в каких случаях возвращается false, не нашёл
    // array_values для того, чтобы ключи по порядку
    $gamesFilesNames = array_values((array) preg_grep('/^([^.])/', $filesInGamesDirectory));
    return array_map(fn($gameFileName) => str_replace('.php', '', $gameFileName), $gamesFilesNames);
}

function play(string $gameNamespace): void
{
    $name = greet();
    outputDescription(constant("{$gameNamespace}\\DESCRIPTION"));

    $getData = "{$gameNamespace}\\getData";

    // is_callable, чтобы phpstan не выдавал ошибку
    if (!function_exists($getData) || !is_callable($getData)) {
        throw new \Exception("Unknown function {$getData}()");
    }

    // Пришлось инициализировать, чтобы phpstan пропускал тесты,
    // не ругался при вызове outputResultMessage, что переменная может быть не определена
    // Хотя такой ситуации быть не может никогда
    $answer = '';
    $result = [];

    $success = true;
    for ($i = 0; $i < ROUNDS_COUNT; ++$i) {
        $result = $getData();
        $answer = askQuestion($result['question']);
        $isCorrect = $answer === (string) $result['correctAnswer'];
        if (!$isCorrect) {
            $success = false;
            break;
        }
        outputSuccessMessage();
    }

    outputResultMessage($success, $result['correctAnswer'], $answer, $name);
}

function getPrevNamespace(): string
{
    $partsNamespace = explode("\\", __NAMESPACE__);
    array_pop($partsNamespace);
    return implode("\\", $partsNamespace);
}
