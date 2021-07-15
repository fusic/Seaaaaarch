<?php

namespace Search;

use Illuminate\Support\Facades\Request;
use Search\Filter\Filter;
use Search\Filter\FilterFactory;

class Searchable {

    protected $params = [];

    public function process($builder, $query = null)
    {
        if (is_null($query)) {
            $query = Request::query();
        }

        Filter::setQueryParams($query);

        foreach ($this->getParams() as $field => $options) {
            $value = $query[$field] ?? null;
            if (empty($value)) {
                $value = $options['default'] ?? null;
            }

            if (is_null($value)) {
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
