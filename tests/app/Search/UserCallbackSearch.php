<?php
namespace Tests\app\Search;

use App\Http\Search\Filter\Hoge;
use Search\Searchable;

class UserCallbackSearch extends Searchable
{
    public function __construct()
    {
        $this->params = [
            'example1' => [
                'type' => 'callback',
                'method' => function ($builder, $key, $value) {
                    $builder->where('name', $value);
                }
            ],
            'example2' => [
                'type' => 'callback',
                'method' => [$this, 'example']
            ]
        ];
    }


    public function example($builder, $key, $value)
    {
        $builder->where('name', $value);

        return $builder;
    }
}
