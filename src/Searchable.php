<?php

namespace Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;

class Searchable {

    protected $params = [];

    public function process(Builder $builder)
    {
        $query = Input::query();

        foreach ($this->params as $field => $options) {
            if (!isset($query[$field]) || $query[$field] == "") {
                continue;
            }

            $builder = $this->createSeachField($builder, $field, $query[$field], $options);
        }

            return $builder;
    }

    private function createSeachField(Builder $builder, $field, $value, $options)
    {
        switch ($options['type']) {
            case 'text':
                if (is_array($value)) {
                    $builder = $builder->where($field, $value[0], $value[1]);
                } else {
                    $builder = $builder->where($field, 'like', '%' . $value . '%');
                }
                break;

            case 'bool':
            case 'integer':
                $builder = $builder->where($field, $value);
                break;

            case 'date':
                $builder = $builder->where($field, $options['comparison'], $value);
                break;

            case 'callback':
                $method = $options['method'];
                $builder = $this->{$method}($builder, $field, $value);
                break;

            default:
                if (is_array($value)) {
                    $builder = $builder->where($field, $value[0], $value[1]);
                } else {
                    $builder = $builder->where($field, 'like', '%' . $value . '%');
                }
                break;
        }

        return $builder;
    }
}
