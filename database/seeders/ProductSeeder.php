<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Silk·épil 3 3-270',
                'slug' => 'silk-epil-3-3-270',
                'SKU'=> "6322-ks",
                'description' => 'Épilateur électrique Silk·épil 3 3-270',
                'regular_price' => 299.00,
                'sale_price' => null,
                'stock_status' => 'instock',
                'featured' => true,
                'quantity' => 50,
                'image' => 'silk-epil-3-3-270.jpg',
                'category_id' => 1,
                
            ],
            [
                'name' => 'Face Spa Pro',
                'slug' => 'face-spa-pro',
                'SKU'=> "552654-ks",
                'description' => 'Nettoyant de peau facial Face Spa Pro',
                'regular_price' => 199.00,
                'sale_price' => null,
                'stock_status' => 'instock',
                'featured' => true,
                'quantity' => 30,
                'image' => 'face-spa-pro.jpg',
                'category_id' => 2,
                
            ],
            [
                'name' => 'Silk·épil 5 5-280',
                'slug' => 'silk-epil-5-5-280',
                'SKU'=> "552654-ks",
                'description' => 'Épilateur électrique Silk·épil 5 5-280',
                'regular_price' => 399.00,
                'sale_price' => null,
                'stock_status' => 'instock',
                'featured' => true,
                'quantity' => 40,
                'image' => 'silk-epil-5-5-280.jpg',
                'category_id' => 3,
                
            ],
            [
                'name' => 'Silk·épil 9 9-890',
                'SKU'=> "552654-ks",
                'slug' => 'silk-epil-9-9-890',
                'description' => 'Épilateur électrique Silk·épil 9 9-890',
                'regular_price' => 499.00,
                'sale_price' => null,
                'stock_status' => 'instock',
                'featured' => true,
                'quantity' => 35,
                'image' => 'silk-epil-9-9-890.jpg',
                'category_id' => 4,
                
            ],
            [
                'name' => 'Silk·épil 9 Flex 9-980',
                'SKU'=> "552654-ks",
                'slug' => 'silk-epil-9-flex-9-980',
                'description' => 'Épilateur électrique Silk·épil 9 Flex 9-980',
                'regular_price' => 599.00,
                'sale_price' => null,
                'stock_status' => 'instock',
                'featured' => true,
                'quantity' => 25,
                'image' => 'silk-epil-9-flex-9-980.jpg',
                'category_id' => 5,
                
            ],
            [
                'name' => 'Tête de rasage Series 3',
                'SKU'=> "552654-ks",
                'slug' => 'tete-rasage-series-3',
                'description' => 'Tête de rasage pour Series 3',
                'regular_price' => 49.99,
                'sale_price' => null,
                'stock_status' => 'instock',
                'featured' => false,
                'quantity' => 100,
                'image' => 'tete-rasage-series-3.jpg',
                'category_id' => 6,
                
            ],
            [
                'name' => 'Rasoir Series 9',
                'SKU'=> "552654-ks",
                'slug' => 'rasoir-series-9',
                'description' => 'Rasoir électrique Series 9',
                'regular_price' => 699.00,
                'sale_price' => null,
                'stock_status' => 'instock',
                'featured' => true,
                'quantity' => 20,
                'image' => 'rasoir-series-9.jpg',
                'category_id' => 7,
                
            ],
            [
                'name' => 'Kit de nettoyage',
                'SKU'=> "552654-ks",
                'slug' => 'kit-nettoyage',
                'description' => 'Kit de nettoyage pour appareils Braun',
                'regular_price' => 29.99,
                'sale_price' => null,
                'stock_status' => 'instock',
                'featured' => false,
                'quantity' => 75,
                'image' => 'kit-nettoyage.jpg',
                'category_id' => 8,
                
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 