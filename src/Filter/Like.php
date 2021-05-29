<?php
namespace Search\Filter;

use Illuminate\Database\Eloquent\Builder;

class Like extends Filter implements FilterInterface {
    protected $defaultOptions = [
        'field' => '',
        'operator' => 'LIKE'
    ];

    public function process($builder, $field, $value)
    {
        $fields = $this->getFieldName($field);
        if (is_string($fields)) {
            $fields = [$fields];
        }

        $value = $this->generateLikeValue($value);

        $builder->where(function($query) use ($fields, $value) {
            foreach ($fields as $field) {
                $query->orWhere($field, $this->options['operator'], $value);
            }
        });
    }

    private function generateLikeValue($value)
    {
        return  '%' . $value . '%';
    }
}
