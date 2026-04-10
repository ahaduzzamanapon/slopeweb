<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeneralSetting::truncate();

        GeneralSetting::create([
            'site_title' => 'Slope Medical',
            'site_description' => 'Premium Medical Accessories & Hospital Equipment.',
            
            'hero_title' => 'Advanced Medical Solutions',
            'hero_description' => 'Equipping healthcare professionals with world-class medical accessories and surgical instruments. Trusted by top hospitals.',
            'hero_image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=2053&auto=format&fit=crop', // Hospital/Medical background
            
            'logo' => null,
            
            'email' => 'contact@slope.test',
            'phone' => '+1 (555) 123-4567',
            'address' => '123 Innovation Drive, Tech City, TC 90210',
            
            'social_links' => [
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
            ],
            
            'footer_text' => '© ' . date('Y') . ' Slope. All rights reserved.',
        ]);
    }
}
