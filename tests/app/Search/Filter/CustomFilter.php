<?php
namespace Tests\app\Search\Filter;

use Illuminate\Database\Eloquent\Builder;
use Search\Filter\Filter;
use Search\Filter\FilterInterface;

class CustomFilter extends Filter implements FilterInterface {
    /**
     * @param Builder $builder
     * @param $field
     * @param $value
     */
    public function process(Builder $builder, $field, $value)
    {
        $builder->where('name', $value);
    }
}

