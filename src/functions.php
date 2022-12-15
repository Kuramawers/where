<?php

namespace BenTools\Where;

use BenTools\Where\DeleteQuery\DeleteQueryBuilder;
use BenTools\Where\Expression\Condition;
use BenTools\Where\Expression\Expression;
use BenTools\Where\Expression\GroupExpression;
use BenTools\Where\Expression\NegatedExpression;
use BenTools\Where\Helper\CaseHelper;
use BenTools\Where\Helper\FieldHelper;
use BenTools\Where\InsertQuery\InsertQueryBuilder;
use BenTools\Where\SelectQuery\SelectQueryBuilder;
use BenTools\Where\UpdateQuery\UpdateQueryBuilder;

/**
 * @param string|Expression $expression
 * @param array             ...$values
 * @return Expression|Condition
 * @throws \InvalidArgumentException
 */
function where($expression, ...$values): Expression
{
    return Expression::where($expression, ...$values);
}

/**
 * @param string|Expression $expression
 * @param array             ...$values
 * @return GroupExpression
 * @throws \InvalidArgumentException
 */
function group($expression, ...$values): GroupExpression
{
    return Expression::group($expression, ...$values);
}

/**
 * @param string|Expression $expression
 * @param array             ...$values
 * @return NegatedExpression
 * @throws \InvalidArgumentException
 */
function not($expression, ...$values): NegatedExpression
{
    return Expression::not($expression, ...$values);
}

function valuesOf(Expression ...$expressions): array
{
    return Expression::valuesOf(...$expressions);
}

/**
 * @param Expression[]|string[]|string ...$columns
 * @return SelectQueryBuilder
 */
function select(...$columns): SelectQueryBuilder
{
    return SelectQueryBuilder::make(...$columns);
}

/**
 * @param Expression[]|string[] ...$tables
 * @return SelectQueryBuilder
 */
function delete(...$tables): DeleteQueryBuilder
{
    return DeleteQueryBuilder::make(...$tables);
}

/**
 * @param array[] ...$values
 * @return InsertQueryBuilder
 * @throws \InvalidArgumentException
 */
function insert(array ...$values): InsertQueryBuilder
{
    return InsertQueryBuilder::load(...$values);
}

/**
 * @param string $table
 * @return UpdateQueryBuilder
 */
function update(string $table): UpdateQueryBuilder
{
    return UpdateQueryBuilder::make($table);
}

/**
 * @param array  $values
 * @param string $placeholder
 * @param string $glue
 * @return string
 * @internal
 */
function placeholders(array $values, string $placeholder = '?', string $glue = ', '): string
{
    return \implode($glue, \array_fill(0, \count($values), $placeholder));
}

/**
 * @param array  $values
 * @return array|false
 * @internal
 */
function random_placeholders(array $values)
{
    $placeholders = \array_map(
        function () {
            return random_string();
        },
        $values
    );

    return $placeholders;
}

/**
 * @param int $length
 * @return string
 * @throws \Exception
 * @internal
 */
function random_string(int $length = 8)
{
    $chars = [
        'a',
        'b',
        'c',
        'd',
        'e',
        'f',
        'g',
        'h',
        'i',
        'j',
        'k',
        'l',
        'm',
        'n',
        'o',
        'p',
        'q',
        'r',
        's',
        't',
        'u',
        'v',
        'w',
        'x',
        'y',
        'z',
    ];

    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= $chars[\random_int(0, 25)];
    }

    return $string;
}

/**
 * @param string $field
 * @return FieldHelper
 */
function field(string $field): FieldHelper
{
    return new FieldHelper($field);
}

/**
 * @param null  $expression
 * @param array ...$values
 * @return CaseHelper
 * @throws \InvalidArgumentException
 */
function conditionnal($expression = null, ...$values): CaseHelper
{
    return CaseHelper::create($expression, ...$values);
}

/**
 * @param null  $expression
 * @param array ...$values
 * @return CaseHelper
 */
function when($expression = null, ...$values): CaseHelper
{
    return CaseHelper::create()->when($expression, ...$values);
}
