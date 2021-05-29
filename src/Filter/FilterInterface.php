<?php
namespace Search\Filter;

interface FilterInterface
{
    public function process($builder, $field, $value);
}
