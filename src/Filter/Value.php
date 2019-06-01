<?php
namespace Search\Filter;

use Illuminate\Database\Eloquent\Builder;

class Value extends Filter implements FilterInterface {
    protected $defaultOptions = [
        'field' => ''
    ];
    public function process(Builder $builder, $field, $value)
    {
        $field = $this->getFieldName($field);
        $builder->where($field, $value);
    }
}
