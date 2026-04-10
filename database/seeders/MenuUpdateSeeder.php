<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuUpdateSeeder extends Seeder
{
    public function run()
    {
        // 1. General Settings
        // Find 'Configurations' parent
        $config = Menu::where('title', 'Configurations')->first();
        
        if ($config) {
            Menu::firstOrCreate(
                ['route' => 'admin.settings.general'],
                [
                    'title' => 'General Settings',
                    'icon' => 'bi bi-gear',
                    'parent_id' => $config->id,
                    'order' => 5,
                ]
            );
        }

        // 2. CMS Modules
        $cms = Menu::firstOrCreate(
            ['title' => 'CMS'],
            [
                'icon' => 'bi bi-collection',
                'order' => 5,
            ]
        );

        Menu::firstOrCreate(
            ['route' => 'admin.categories.index'],
            [
                'title' => 'Categories',
                'parent_id' => $cms->id,
                'order' => 1,
            ]
        );

        Menu::firstOrCreate(
            ['route' => 'admin.products.index'],
            [
                'title' => 'Products',
                'parent_id' => $cms->id,
                'order' => 2,
            ]
        );
    }
}
