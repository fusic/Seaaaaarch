<?php

namespace Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Search\Filter\FilterFactory;

class Searchable {

    protected $params = [];

    public function process(Builder $builder, $query = null)
    {
        if (is_null($query)) {
            $query = Input::query();
        }

        foreach ($this->getParams() as $field => $options) {
            $value = $query[$field] ?? null;
            if (is_null($value)) {
                continue;
            }
            if ($query[$field] == "") {
                continue;
            }

            //if ($field == 'hoge') {
            $filter = FilterFactory::create($options['type']);
            $filter->setOptions($options);
            $filter->process($builder, $field, $value);
            //}
            //$builder = $this->createSearchField($builder, $field, $query[$field], $options);
        }

        return $builder;
    }

    private function createSearchField(Builder $builder, $field, $value, $options)
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

    /**
     * getParams
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
