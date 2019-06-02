# Seaaaaarch

[![CircleCI](https://img.shields.io/circleci/build/github/fusic/Seaaaaarch.svg)](https://circleci.com/gh/fusic/Seaaaaarch)
[![Scrutinizer code quality (GitHub/Bitbucket)](https://img.shields.io/scrutinizer/quality/g/fusic/Seaaaaarch.svg)](https://scrutinizer-ci.com/g/fusic/Seaaaaarch/)
[![Codecov](https://img.shields.io/codecov/c/github/fusic/Seaaaaarch.svg)](https://codecov.io/gh/fusic/Seaaaaarch)

## Install

```
composer require fusic/Seaaaaarch
```

## Setting

add providers

```
Search\Providers\SearchServiceProvider::class
```

## Create Searchable

app\Search\HogeSearch.php
```
<?php

namespace App\Search;

use Illuminate\Database\Eloquent\Builder;
use Search\Searchable;

class HogeSearch extends Searchable
{
    public function __construct()
    {
        $this->params = [
            'example1' => [
                'type' => 'value',
                'operator' => '='
            ],
            'example2' => [
                'type' => 'like',
                'field' => 'name'
            ],
            'example3' => [
                'type' => 'like',
                'field' => ['name', 'email']
            ],
            'example4' => [
                'type' => 'callback',
                'method' => function (Builder $builder, $key, $value) {
                    $builder->where('name', $value);
                }
            ],
            'example5' => [
                'type' => 'callback',
                'method' => [$this, 'example']
            ],
            'example6' => [
                'type' => CustomFilter::class
            ]
        ];
    }


    public function example(Builder $builder, $key, $value)
    {
        $body = trim($value);
        $builder->where($key, 'like', $body);
        
        return $builder;
    }
}
```

# usage

```
ExampleMode::search(new HogeSearch())
  ->whre('hoge', 'fuga')
```

or

```
ExampleMode::whre('hoge', 'fuga')
  ->search(new HogeSearch())
```
