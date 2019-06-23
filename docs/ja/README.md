# Seaaaaach

`Seaaaaach` はLaravelで検索を簡単にするためのPackageです。

## インストール

```php
composer require fusic/Seaaaaarch
```

### Providersへの登録

`/config/app.php` の `providers` へ登録してください

```php
Search\Providers\SearchServiceProvider::class
```

## 使い方

1. [基本の使い方](/docs/basic.md)
2. [Searchableの設定](/docs/settings.md)