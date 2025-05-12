<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'Braun',
            'slug' => 'braun',
            'description' => 'Braun est une marque allemande d\'appareils électroménagers et de produits de soins personnels.',
            'image' => 'braun-logo.png'
        ]);
    }
} 