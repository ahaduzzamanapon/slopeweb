<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class UpdateMenuWithContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CMS Section
        if (!Menu::where('title', 'Services')->exists()) {
            Menu::create([
                'title' => 'Services',
                'route' => 'admin.services.index',
                'icon' => 'bi bi-list-check',
                'order' => 10,
            ]);
        }

        if (!Menu::where('title', 'Sliders')->exists()) {
            Menu::create([
                'title' => 'Sliders',
                'route' => 'admin.sliders.index',
                'icon' => 'bi bi-images',
                'order' => 11,
            ]);
        }

        // Content Management
        if (!Menu::where('title', 'Categories')->exists()) {
            Menu::create([
                'title' => 'Categories',
                'route' => 'admin.categories.index',
                'icon' => 'bi bi-folder',
                'order' => 20,
            ]);
        }

        if (!Menu::where('title', 'Products')->exists()) {
            Menu::create([
                'title' => 'Products',
                'route' => 'admin.products.index',
                'icon' => 'bi bi-box-seam',
                'order' => 21,
            ]);
        }

        // Contact Submissions
        if (!Menu::where('title', 'Contact Submissions')->exists()) {
            Menu::create([
                'title' => 'Contact Submissions',
                'route' => 'admin.contacts.index',
                'icon' => 'bi bi-envelope',
                'order' => 30,
            ]);
        }

        // Settings
        if (!Menu::where('title', 'General Settings')->exists()) {
            Menu::create([
                'title' => 'General Settings',
                'route' => 'admin.settings.general',
                'icon' => 'bi bi-gear',
                'order' => 40,
            ]);
        }
    }
}
