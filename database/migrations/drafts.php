<?php

$product = [
    'id' => 1,
    'name' => 'Product name',
    'description' => 'Product description',
    'properties' => [
        ['key' => 'Property key 1', 'value' => 'Property value 1']
    ],
    'images' => [
        'image_path'
    ],
    'category_id' => 1,
    'manufacturer_id' => 1,
    'user_id' => 1
];

$products = [
    [
        'id' => 1,
        'product_id' => $product['id'],
        'sizes_id' => 1,
        'color_id' => null,
        'delivery_id' => 1,
        'images' => [
            'image_path'
        ],
    ]
];
