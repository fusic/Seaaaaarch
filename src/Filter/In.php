<?php
namespace Search\Filter;

class In extends Filter implements FilterInterface {
    protected $defaultOptions = [
        'field' => ''
    ];
    public function process($builder, $field, $value)
    {
        if (is_string($value)) {
            $value = [$value];
        }

        $field = $this->getFieldName($field);
        $builder->whereIn($field, $value);
    }
}
