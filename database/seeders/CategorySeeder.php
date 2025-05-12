<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Silk·épil 3',
                'slug' => 'silk-epil-3',
                'image' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Face Spa',
                'slug' => 'face-spa',
                'image' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Silk·épil 5',
                'slug' => 'silk-epil-5',
                'image' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Silk·épil 9',
                'slug' => 'silk-epil-9',
                'image' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Silk·épil 9 Flex',
                'slug' => 'silk-epil-9-flex',
                'image' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Têtes de rasage',
                'slug' => 'tetes-de-rasage',
                'image' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Rasoirs',
                'slug' => 'rasoirs',
                'image' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Accessoires',
                'slug' => 'accessoires',
                'image' => null,
                'parent_id' => null,
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 