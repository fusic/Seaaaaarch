<?php
namespace Search\Filter;

class Value extends Filter implements FilterInterface {
    protected $defaultOptions = [
        'field' => '',
        'operator' => '='
    ];
    public function process($builder, $field, $value)
    {
        $field = $this->getFieldName($field);
        $builder->where($field, $this->options['operator'], $value);
    }
}
