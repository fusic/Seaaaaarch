# Filterの作成

Filterを作成することで、 `Value` や `Like` といったような共通処理を作成することが出来ます。  
下記コマンドを実行することで、 `App\Search\Filter` にFilter用のファイルが作成されます。

```php
php artisan make:filter ExampleFilter
```

サンプル (App\Search\Filter\ExampleFilter)

```
<?php
namespace App\Search\Filter;

use Search\Filter\Filter;
use Search\Filter\FilterInterface;

class ExampleFilter extends Filter implements FilterInterface {
    protected $defaultOptions = [];

    public function process($builder, $field, $value)
    {
        // ここに検索条件の処理を記載します
        // 20歳以上
        $builder->where('age', '>=', 20);
    }
}
```