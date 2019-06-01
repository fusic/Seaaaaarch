<?php
namespace Search\Filter;

use Illuminate\Database\Eloquent\Builder;

class In extends Filter implements FilterInterface {
    protected $defaultOptions = [
        'field' => ''
    ];
    public function process(Builder $builder, $field, $value)
    {
        if (is_string($value)) {
            $value = [$value];
        }

        $field = $this->getFieldName($field);
        $builder->whereIn($field, $value);
    }
}
