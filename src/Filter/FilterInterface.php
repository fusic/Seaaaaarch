<?php
namespace Search\Filter;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function process(Builder $builder, $field, $value);
}
