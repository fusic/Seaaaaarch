<?php
namespace Tests\app\Search;

use App\Http\Search\Filter\Hoge;
use Search\Searchable;

class UserLikeSearch extends Searchable
{
    public function __construct()
    {
        $this->params = [
            'name' => [
                'type' => 'like'
            ],
            'example' => [
                'type' => 'like',
                'field' => 'name'
            ],
            'email' => [
                'type' => 'like',
                'field' => ['name', 'email']
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
