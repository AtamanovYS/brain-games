<?php

namespace PhpProjectLvl1\Games\Calc;

use NXP\MathExecutor;

const DESCRIPTION = 'What is the result of the expression?';

function play(): array
{
    $config = getConfig();
    $firstNumber = mt_rand($config['firstMinNumber'], $config['firstMaxNumber']);
    $secondNumber = mt_rand($config['secondMinNumber'], $config['secondMaxNumber']);
    $operators = ["*", "+", "-"];
    $operator = $operators[array_rand($operators)];
    $expression = "{$firstNumber} {$operator} {$secondNumber}";
    $executor = new MathExecutor();
    $expressionResult = $executor->execute($expression);

    $result = [
        'question'      => $expression,
        'correctAnswer' => $expressionResult,
    ];
    return $result;
}

function getConfig(): array
{
    return [
        'firstMinNumber'    => 0,
        'firstMaxNumber'    => 100,
        'secondMinNumber'   => 0,
        'secondMaxNumber'   => 100,
    ];
}
