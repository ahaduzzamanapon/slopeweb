<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class AddSliderMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if CMS menu exists, if not create it (optional, or just add to root)

        // Add Services
        if (!Menu::where('title', 'Services')->exists()) {
            Menu::create([
                'title' => 'Services',
                'route' => 'admin.services.index',
                'icon' => 'bi bi-grid', // Bootstrap icon
                'order' => 2,
            ]);
        }

        // Add Sliders
        if (!Menu::where('title', 'Sliders')->exists()) {
            Menu::create([
                'title' => 'Sliders',
                'route' => 'admin.sliders.index',
                'icon' => 'bi bi-images',
                'order' => 3,
            ]);
        }
    }
}
