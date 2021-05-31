# Searchableの設定

Searchableを設定することで、シンプルな検索から詳細な検索まで柔軟に対応することが可能です。

サンプル
```php


<?php

namespace App\Search;

use Search\Searchable;

class HogeSearch extends Searchable
{
    public function __construct()
    {
        $this->params = [
            'name' => [
                'type' => 'value',
                'operator' => '='
            ],
            'address' => [
                'type' => 'like',
                'field' => ['address1', 'address2']
            ],
            'kana' => [
                'type' => 'callback',
                'method' => function ($builder, $key, $value) {
                    $name = mb_convert_kana($value, 'Hc');
                    $builder->where('name', $name);
                }
            ],
            'extra' => [
                'type' => ExampleFilter::class
            ]
        ];
    }
}
```

## Searchableに設定する書式

paramsのキーにQueryStringのキー名を指定します

```php
$this->params = [
    'QueryStringのキー名' => [
        'type' => '検索種別',
        'option1' => 'option',
        'option2' => 'option'
    ]
];
```

## typeに指定する種類

### Value

検索値に対して、条件に一致するかで検索を行う。

|  キー名  |  内容  |  必須  |
| ---- | ---- | ---- |
|  type  |  value  |  〇  |
|  field  |  検索対象のDBカラム名 <br >※デフォルトはQueryStringのキー名<br >※配列を指定することで複数カラムに対して検索  |  -  |
|  operator  |  SQLの演算子(=<>等)<br >※デフォルトは 「=」 |  -  |


### Like

検索値に対して、LIKEで検索する

|  キー名  |  内容  |  必須  |
| ---- | ---- | ---- |
|  type  |  like  |  〇  |
|  field  |  検索対象のDBカラム名<br >※デフォルトはQueryStringのキー名<br >※配列を指定することで複数カラムに対して検索 |  -  |
|  operator  |  SQLの演算子(デフォルトは 「LIKE」 )  |  -  |


### In

検索値に対して、Inで検索する

|  キー名  |  内容  |  必須  |
| ---- | ---- | ---- |
|  type  |  in  |  〇  |
|  field  |  検索対象のDBカラム名<br >※デフォルトはQueryStringのキー名<br >※配列を指定することで複数カラムに対して検索 |  -  |


### Callbak

検索条件を自由に組み立てたい場合に使用します。

|  キー名  |  内容  |  必須  |
| ---- | ---- | ---- |
|  type  |  callback  |  〇  |
|  method  |  検索条件を組み立てるメソッド  |  -  |

#### サンプル1

無名関数を利用

```php
$this->params = [
    'name' => [
        'type' => 'callback',
        'method' => function ($builder, $key, $value) {
            // ここで条件を組み立てます
            $name = mb_convert_kana($value, 'Hc');
            $builder->where('name', $name);
        }
    ]
];
```

#### サンプル2

クラス内のメソッドを利用

```php
    public function __construct()
    {
        $this->params = [
            'name' => [
                'type' => 'callback',
                'method' => [$this, 'example']
        ]
    ];

    public function example($builder, $key, $value)
    {
        // ここで条件を組み立てます
        $name = mb_convert_kana($value, 'Hc');
        $builder->where('name', $name);
    }
```

## Filterカスタマイズ

Filterを作成することで、 `Value` や `Like` といったような共通処理を作成することが出来ます。  
※作成の仕方については、[Filterの作成](/docs/ja/filter.md) を参照してください。

|  キー名  |  内容  |  必須  |
| ---- | ---- | ---- |
|  type  |  Filterのクラス名を指定  |  〇  |

サンプル
```
$this->params = [
    'name' => [
        // この指定で、20歳以上の条件がかかります
        'type' => ExampleFilter::class
    ]
];
```
