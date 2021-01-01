<?php

namespace PhpProjectLvl1\Games\Calc;

function play(array &$config): array
{
    $firstNumber = mt_rand($config['firstMinNumber'], $config['firstMaxNumber']);
    $secondNumber = mt_rand($config['secondMinNumber'], $config['secondMaxNumber']);
    $operators = ["*", "+", "-"];
    $operatorIndex = mt_rand(0, count($operators) - 1);
    $expression = "{$firstNumber} {$operators[$operatorIndex]} {$secondNumber}";
    $expressionResult = eval("return {$expression};");

    $result = [
    'question'      => $expression,
    'correctAnswer' => $expressionResult];
    return $result;
}

function getConfig(): array
{
    $config = [];
    $config['firstMinNumber'] = 0;
    $config['firstMaxNumber'] = 100;
    $config['secondMinNumber'] = 0;
    $config['secondMaxNumber'] = 100;
    $config['description'] = 'What is the result of the expression?';
    return $config;
}
