<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::truncate();

        $services = [
            [
                'title' => 'Web Development',
                'description' => 'Custom websites tailored to your brand needs using the latest technologies like Laravel and React.',
                'icon' => 'code', // Abstract icon name reference
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop',
            ],
            [
                'title' => 'UI/UX Design',
                'description' => 'User-centric designs that provide seamless and enjoyable experiences for your customers.',
                'icon' => 'pen-tool',
                'image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?q=80&w=2000&auto=format&fit=crop',
            ],
            [
                'title' => 'Digital Marketing',
                'description' => 'Boost your online visibility and reach your target audience with our data-driven marketing strategies.',
                'icon' => 'trending-up',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015&auto=format&fit=crop',
            ],
            [
                'title' => 'SEO Optimization',
                'description' => 'Improve your search engine rankings and drive organic traffic to your website.',
                'icon' => 'search',
                'image' => 'https://images.unsplash.com/photo-1571721795195-a2ca5d3079a3?q=80&w=2070&auto=format&fit=crop',
            ],
        ];

        foreach ($services as $key => $service) {
            Service::create([
                'title' => $service['title'],
                'slug' => Str::slug($service['title']),
                'short_description' => Str::limit($service['description'], 100),
                'description' => $service['description'],
                'icon' => $service['icon'],
                'image' => $service['image'],
                'order' => $key + 1,
                'active' => true,
            ]);
        }
    }
}
