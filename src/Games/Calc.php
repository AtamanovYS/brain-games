<?php

namespace BrainGames\Games\Calc;

const DESCRIPTION = 'What is the result of the expression?';

function play(): void
{
    \BrainGames\Engine\play(DESCRIPTION, __NAMESPACE__ . '\\getData');
}

function getData(): array
{
    $config = getConfig();
    $firstNumber = mt_rand($config['firstMinNumber'], $config['firstMaxNumber']);
    $secondNumber = mt_rand($config['secondMinNumber'], $config['secondMaxNumber']);
    $operators = ["*", "+", "-"];
    $operator = $operators[array_rand($operators)];
    $expression = "{$firstNumber} {$operator} {$secondNumber}";
    $expressionResult = evaluateExpression($firstNumber, $secondNumber, $operator);
    return [
        'question'      => $expression,
        'correctAnswer' => (string) $expressionResult,
    ];
}

function evaluateExpression(int $firstNumber, int $secondNumber, string $operator): int
{
    switch ($operator) {
        case '+':
            return $firstNumber + $secondNumber;
        case '-':
            return $firstNumber - $secondNumber;
        case '*':
            return $firstNumber * $secondNumber;
        default:
            throw new \Exception("Unknown operator: '{$operator}");
    }
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
