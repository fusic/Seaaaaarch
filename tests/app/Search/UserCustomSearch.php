<?php
namespace Tests\app\Search;

use Search\Searchable;
use Tests\app\Search\Filter\CustomFilter;

class UserCustomSearch extends Searchable
{
    public function __construct()
    {
        $this->params = [
            'example1' => [
                'type' => CustomFilter::class
            ]
        ];
    }
}
