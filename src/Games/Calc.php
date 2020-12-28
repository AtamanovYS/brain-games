<?php

namespace Php\Project\Lvl1\Games\Calc;

function play(array $gameConfig): array
{
    $firstNumber = mt_rand($gameConfig['firstMinNumber'], $gameConfig['firstMaxNumber']);
    $secondNumber = mt_rand($gameConfig['secondMinNumber'], $gameConfig['secondMaxNumber']);
    $operators = ["*", "+", "-"];
    $operatorIndex = mt_rand(0, count($operators) - 1);
    $expression = "{$firstNumber} {$operators[$operatorIndex]} {$secondNumber}";
    $expressionResult = eval("return {$expression};");

    $result = [
    'question'      => $expression,
    'correctAnswer' => $expressionResult];
    return $result;
}
