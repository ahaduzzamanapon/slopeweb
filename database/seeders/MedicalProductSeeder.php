<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MedicalProductSeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Product::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $surgical = Category::where('slug', 'surgical-equipment')->first();
        $diagnostic = Category::where('slug', 'diagnostic-imaging')->first();
        $monitoring = Category::where('slug', 'patient-monitoring')->first();

        // Surgical Products
        if ($surgical) {
            Product::create([
                'category_id' => $surgical->id,
                'title' => 'Advanced Surgical Table',
                'slug' => 'advanced-surgical-table',
                'price' => 15000.00,
                'short_description' => 'Hydraulic operating table for general surgery.',
                'description' => 'A versatile, multi-purpose operating table designed for modern surgical environments. Features electric height adjustment and trendelenburg tilt.',
                'brand' => 'Steris',
                'model' => '5085 SRT',
                'origin' => 'USA',
                'assembly' => 'USA',
                'warranty' => '2 Years (Parts & Service)',
                'features' => '<ul><li>Slide/Rotate Table Top for 360-degree imaging</li><li>1200 lb weight capacity</li><li>Intuitive hand control</li><li>Auto-leveling function</li></ul>',
                'stock_status' => 'in_stock',
                'is_featured' => true,
                'active' => true,
            ]);
        }

        // Diagnostic Products
        if ($diagnostic) {
            Product::create([
                'category_id' => $diagnostic->id,
                'title' => 'Digital Ultrasound System',
                'slug' => 'digital-ultrasound-system',
                'price' => 25000.00,
                'short_description' => 'High-resolution portable ultrasound scanner.',
                'description' => 'Compact and powerful diagnostic ultrasound system offering exceptional image quality for various clinical applications.',
                'brand' => 'GE Healthcare',
                'model' => 'Logiq E10',
                'origin' => 'USA',
                'assembly' => 'China',
                'warranty' => '1 Year Comprehensive',
                'features' => '<ul><li>XDclear probe technology</li><li>OLED Monitor</li><li>Raw Data Architecture</li><li>Real-time shear wave elastography</li></ul>',
                'stock_status' => 'in_stock',
                'is_featured' => true,
                'active' => true,
            ]);
        }

        // Patient Monitoring
        if ($monitoring) {
            Product::create([
                'category_id' => $monitoring->id,
                'title' => 'Vital Signs Monitor',
                'slug' => 'vital-signs-monitor',
                'price' => 3500.00,
                'short_description' => 'Multi-parameter patient monitor for ICU.',
                'description' => 'Accurate monitoring of ECG, NIBP, SpO2, and temperature. Suitable for adult, pediatric, and neonatal patients.',
                'brand' => 'Philips',
                'model' => 'Efficia CM12',
                'origin' => 'Netherlands',
                'assembly' => 'China',
                'warranty' => '18 Months',
                'features' => '<ul><li>12-inch color touchscreen</li><li>ST Analysis & Arrhythmia detection</li><li>HL7 connectivity</li><li>48-hour data storage</li></ul>',
                'stock_status' => 'in_stock',
                'is_featured' => true,
                'active' => true,
            ]);
        }
    }
}
