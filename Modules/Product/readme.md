# Module: Product

It contains everything by a product.

## Install

- Add to `config/app.php` file `aliases` array
```php
'aliases => [
    ...,
    'PriceFormat' => \Modules\Product\Facades\PriceFormatter::class,
];
```