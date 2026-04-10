<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Category::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $categories = [
            'Surgical Equipment',
            'Diagnostic Imaging',
            'Patient Monitoring',
            'Medical Furniture',
            'Rehabilitation',
            'Laboratory Equipment'
        ];

        foreach ($categories as $key => $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'image' => null, // Placeholders can be added if needed
                'order' => $key + 1,
                'active' => true,
            ]);
        }
    }
}
