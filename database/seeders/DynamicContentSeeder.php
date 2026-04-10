<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DynamicContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed existing Team Members
        $team = [
            ['name' => 'Engr. Md. Saidul Islam Sobuj', 'designation' => 'Managing Director', 'type' => 'management', 'image' => 'https://ui-avatars.com/api/?name=Saidul+Islam&background=random&size=256', 'order' => 1],
            ['name' => 'Md. Mahabubur Rahman', 'designation' => 'General Manager', 'type' => 'management', 'image' => 'https://ui-avatars.com/api/?name=Mahabubur+Rahman&background=3819e7&color=fff&size=128', 'order' => 2],
            ['name' => 'Mohsina Khatun', 'designation' => 'HR & Accounts', 'type' => 'management', 'image' => 'https://ui-avatars.com/api/?name=Mohsina+Khatun&background=facc15&color=000&size=128', 'order' => 3],
            ['name' => 'Md. Sajib Rayhan', 'designation' => 'Sales & Service Engineer', 'type' => 'engineer', 'image' => 'https://ui-avatars.com/api/?name=Sajib+Rayhan&background=slate&color=fff&size=128', 'order' => 4],
            ['name' => 'Md. Roman', 'designation' => 'Sales & Service Engineer', 'type' => 'engineer', 'image' => 'https://ui-avatars.com/api/?name=Md+Roman&background=slate&color=fff&size=128', 'order' => 5],
            ['name' => 'Rahat Hossen', 'designation' => 'Sales & Service Engineer', 'type' => 'engineer', 'image' => 'https://ui-avatars.com/api/?name=Rahat+Hossen&background=slate&color=fff&size=128', 'order' => 6],
            ['name' => 'Estahid Alam', 'designation' => 'Sales & Service Engineer', 'type' => 'engineer', 'image' => 'https://ui-avatars.com/api/?name=Estahid+Alam&background=slate&color=fff&size=128', 'order' => 7],
        ];

        foreach ($team as $member) {
            \App\Models\TeamMember::create($member);
        }

        // 2. Seed existing Menus into the Admin Panel Sidebar
        $menus = [
            ['title' => 'Team Members', 'route' => 'admin.team.index', 'icon' => 'bi-people', 'order' => 45],
            ['title' => 'Our Clients', 'route' => 'admin.clients.index', 'icon' => 'bi-building', 'order' => 46],
            ['title' => 'Quotations', 'route' => 'admin.quotations.index', 'icon' => 'bi-file-earmark-pdf', 'order' => 25],
        ];

        foreach ($menus as $menu) {
            \App\Models\Menu::create($menu);
        }

        // 3. Set the General Settings content for the MD message to dummy text 
        $settings = \App\Models\GeneralSetting::first();
        if ($settings) {
            $settings->md_name = 'Engr. Md. Saidul Islam Sobuj';
            $settings->md_message = 'Currently generated via standard dummy text. We invite you to use the power of the platform to replace this with your own customized content.';
            $settings->save();
        }
    }
}
