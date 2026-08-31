<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProductCategory;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@akyas.com'],
            [
                'name' => 'Admin',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]
        );

        // Create Product Categories
        $productCategories = [
            ['name' => 'Jumbo Bags', 'slug' => 'jumbo-bags'],
            ['name' => 'PP Woven Sacks', 'slug' => 'pp-woven-sacks'],
            ['name' => 'Container Liners', 'slug' => 'container-liners'],
        ];

        foreach ($productCategories as $category) {
            ProductCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        // Create Blog Categories
        $blogCategories = [
            ['name' => 'Innovation', 'slug' => 'innovation'],
            ['name' => 'Industry News', 'slug' => 'industry-news'],
            ['name' => 'Company Updates', 'slug' => 'company-updates'],
        ];

        foreach ($blogCategories as $category) {
            BlogCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
