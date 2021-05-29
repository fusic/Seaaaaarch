<?php
namespace Tests\app\Search;

use App\Http\Search\Filter\Hoge;
use Search\Searchable;

class UserSearch extends Searchable
{
    public function __construct()
    {
        $this->params = [
            'name' => [
                'type' => 'value'
            ],
            'email' => [
                'type' => 'in'
            ]
        ];
    }


    public function example($builder, $key, $value)
    {
        $body = trim($value);
        $builder->where($key, 'like', $body);

        return $builder;
    }
}
