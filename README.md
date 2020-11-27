# Modseven - pagination module
Pagination module for Modseven

## Getting Started

use composer

## Usage

```php

class Product extends Controller
{
    public function index() {

    	$products_count = ORM::factory(Product::class)->countAll();

    	$pagination = Pagination::factory([
            'total_items' => $products_count,
            'items_per_page' => 20,
        ]);

    	$products = ORM::factory(Product::class)
    	    ->limit($pagination->items_per_page)
    	    ->offset($pagination->offset)
    	    ->find_all();

    	$content = View::factory('index/v_products')
    	    ->set('products', $products)
    	    ->set('pagination', $pagination);
    }
 }

```

## License
This package is open-sourced software licensed under the [BSD license](https://koseven.ga/LICENSE.md)