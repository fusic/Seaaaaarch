<?php
namespace Tests\app\Search\Filter;

use Search\Filter\Filter;
use Search\Filter\FilterInterface;

class CustomFilter extends Filter implements FilterInterface {
    /**
     * @param Builder $builder
     * @param $field
     * @param $value
     */
    public function process($builder, $field, $value)
    {
        $builder->where('name', $value);
    }
}

