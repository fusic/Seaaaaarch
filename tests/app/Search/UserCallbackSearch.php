<?php
namespace Tests\app\Search;

use App\Http\Search\Filter\Hoge;
use Illuminate\Database\Eloquent\Builder;
use Search\Searchable;

class UserCallbackSearch extends Searchable
{
    public function __construct()
    {
        $this->params = [
            'example1' => [
                'type' => 'callback',
                'method' => function (Builder $builder, $key, $value) {
                    $builder->where('name', $value);
                }
            ],
            'example2' => [
                'type' => 'callback',
                'method' => [$this, 'example']
            ]
        ];
    }


    public function example(Builder $builder, $key, $value)
    {
        $builder->where('name', $value);

        return $builder;
    }
}
