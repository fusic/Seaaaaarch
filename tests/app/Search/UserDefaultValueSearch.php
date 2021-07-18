<?php
namespace Tests\app\Search;

use Search\Searchable;

class UserDefaultValueSearch extends Searchable
{
    public function __construct()
    {
        $this->params = [
            'name' => [
                'type' => 'value',
                'default' => 'UserDefaultValue',
            ],
        ];
    }


    public function example($builder, $key, $value)
    {
        $body = trim($value);
        $builder->where($key, 'like', $body);

        return $builder;
    }
}
