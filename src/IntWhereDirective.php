<?php

declare(strict_types = 1);

namespace Graphpinator\WhereDirectives;

final class IntWhereDirective extends \Graphpinator\WhereDirectives\BaseWhereDirective
{
    protected const NAME = 'intWhere';
    protected const DESCRIPTION = 'Graphpinator intWhere directive.';
    protected const TYPE = \Graphpinator\Type\Spec\IntType::class;

    protected static function satisfiesCondition(int $value, ?int $equals, ?int $greaterThan, ?int $lessThan) : bool
    {
        if (\is_int($equals) && $value !== $equals) {
            return false;
        }

        if (\is_int($greaterThan) && $value < $greaterThan) {
            return false;
        }

        return !\is_int($lessThan) || $value <= $lessThan;
    }

    protected function getFieldDefinition() : \Graphpinator\Argument\ArgumentSet
    {
        return new \Graphpinator\Argument\ArgumentSet([
            \Graphpinator\Argument\Argument::create('field', \Graphpinator\Container\Container::String()),
            \Graphpinator\Argument\Argument::create('not', \Graphpinator\Container\Container::Boolean()->notNull())
                ->setDefaultValue(false),
            \Graphpinator\Argument\Argument::create('equals', \Graphpinator\Container\Container::Int()),
            \Graphpinator\Argument\Argument::create('greaterThan', \Graphpinator\Container\Container::Int()),
            \Graphpinator\Argument\Argument::create('lessThan', \Graphpinator\Container\Container::Int()),
            \Graphpinator\Argument\Argument::create('orNull', \Graphpinator\Container\Container::Boolean()->notNull())
                ->setDefaultValue(false),
        ]);
    }
}
