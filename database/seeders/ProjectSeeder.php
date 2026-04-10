<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::truncate();

        $projects = [
            [
                'title' => 'Fintech Dashboard',
                'client' => 'FinanceCorp',
                'description' => 'A comprehensive dashboard for tracking financial metrics and analytics.',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop',
                'technologies' => ['Laravel', 'Vue.js', 'Chart.js'],
                'completion_date' => '2024-01-15',
            ],
            [
                'title' => 'E-commerce Platform',
                'client' => 'ShopifyPlus',
                'description' => 'A scalable e-commerce solution with multi-vendor support.',
                'image' => 'https://images.unsplash.com/photo-1556742049-0cfed4f7a07d?q=80&w=2070&auto=format&fit=crop',
                'technologies' => ['React', 'Node.js', 'MongoDB'],
                'completion_date' => '2023-11-20',
            ],
            [
                'title' => 'Healthcare App',
                'client' => 'MediCare',
                'description' => 'Mobile application for patient appointment booking and tele-medicine.',
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?q=80&w=2028&auto=format&fit=crop',
                'technologies' => ['Flutter', 'Firebase'],
                'completion_date' => '2024-03-10',
            ],
        ];

        foreach ($projects as $key => $project) {
            Project::create([
                'title' => $project['title'],
                'slug' => Str::slug($project['title']),
                'short_description' => Str::limit($project['description'], 80),
                'description' => $project['description'],
                'image' => $project['image'],
                'client_name' => $project['client'],
                'technologies' => $project['technologies'],
                'completion_date' => $project['completion_date'],
                'order' => $key + 1,
                'active' => true,
            ]);
        }
    }
}
