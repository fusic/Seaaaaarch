# 基本の使い方

## Searchableの作成

`Seaaaaach`  は `Searchableクラス` を作成して、 Searchableクラスに検索条件の設定を行います。  
以下のコマンドを実行することで `App\Search` 以下に`Searchableクラス` が作成されます。

```php
php artisan make:searchable UsersSearch
```

app\Search\UsersSearch.php
```php
<?php
namespace App\Search;

use Search\Searchable;

class UserSearch extends Searchable
{
    public function __construct()
    {
        $this->params = [
            // ここに検索条件を記載します
            // サンプルでは名前 と 住所を検索できるようにします
            'name' => [
                'type' => 'value'
            ],
            'address' => [
                'type' => 'like'
            ],
        ];
    }
}
```
※Searchableの詳細な設定項目については[Searchableの設定](/docs/settings.md)を参照してください。

## bladeの準備

検索用の画面を作成します。(index.blade.php等)

```html
<form action="{{ route('users.search') }}" method="post">
    @csrf
    <div class='row'>
        <div class='col-md-6'>
            <div class='form-group'>
                <input name="name" />
            </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
                <input name="address" />
            </div>
        </div>
    </div>
    <div style="text-align: center;">
        <button class='btn-default'>検索</button>
    </div>
</form>
```

## コントローラーに検索用アクションを作成

上記で作成した検索用POSTを受け取るアクションを作成します。  
`QueryParser::parse` に Searchableクラス のインスタンスを渡します。


UsersController.php
```
public function search() {
    $query = QueryParser::parse(new UsersSearch());
    return redirect()->route('users.index', $query);
}
```

## 検索の実行

検索を実行します。  
Seaaaaachは `eloquent` に `searchメソッド` を追加します。  
searchに対して `Searchableインスタンス` を渡すことで、 Searchableに設定された検索条件で検索を行います。

```php
public function index() {
    UserModel::search(new UserSearch())->where('example', 'test');
    // or
    UserModel::where('example', 'test')->search(new UserSearch())
}
```