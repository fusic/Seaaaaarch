<?php

namespace Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Search\Filter\Filter;
use Search\Filter\FilterFactory;

class Searchable {

    protected $params = [];

    public function process(Builder $builder, $query = null)
    {
        if (is_null($query)) {
            $query = Input::query();
        }

        Filter::setQueryParams($query);

        foreach ($this->getParams() as $field => $options) {
            $value = $query[$field] ?? null;
            if (is_null($value)) {
                continue;
            }
            if ($query[$field] == "") {
                continue;
            }

            $filter = FilterFactory::create($options['type']);
            $filter->setOptions($options);
            $filter->process($builder, $field, $value);
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
