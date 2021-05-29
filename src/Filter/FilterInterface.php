<?php
namespace Search\Filter;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function process($builder, $field, $value);
}
