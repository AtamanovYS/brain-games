<?php

namespace PhpProjectLvl1\Games\Calc;

function play(array &$config): array
{
    $firstNumber = mt_rand($config['firstMinNumber'], $config['firstMaxNumber']);
    $secondNumber = mt_rand($config['secondMinNumber'], $config['secondMaxNumber']);
    $operators = ["*", "+", "-"];
    $operatorIndex = mt_rand(0, array_key_last($operators));
    $expression = "{$firstNumber} {$operators[$operatorIndex]} {$secondNumber}";
    $expressionResult = eval("return {$expression};");

    $result = [
    'question'      => $expression,
    'correctAnswer' => $expressionResult,
    ];
    return $result;
}

function getConfig(): array
{
    $config = [
    'firstMinNumber'    => 0,
    'firstMaxNumber'    => 100,
    'secondMinNumber'   => 0,
    'secondMaxNumber'   => 100,
    'description'       => 'What is the result of the expression?',
    ];
    return $config;
}
