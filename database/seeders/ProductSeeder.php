<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        // 1. Hospital Equipments Hierarchy
        $hospitalParent = DB::table('categories')->insertGetId([
            'name' => 'Hospital Equipments',
            'slug' => 'hospital-equipments',
            'active' => 1,
            'order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $surgicalId = DB::table('categories')->insertGetId([
            'parent_id' => $hospitalParent,
            'name' => 'Surgical Equipment',
            'slug' => 'surgical-equipment',
            'active' => 1,
            'order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('categories')->insert([
            ['parent_id' => $hospitalParent, 'name' => 'Patient Monitoring', 'slug' => 'patient-monitoring', 'active' => 1, 'order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['parent_id' => $hospitalParent, 'name' => 'Medical Furniture', 'slug' => 'medical-furniture', 'active' => 1, 'order' => 3, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 2. Diagnostic Equipments Hierarchy
        $diagnosticParent = DB::table('categories')->insertGetId([
            'name' => 'Diagnostic Equipments',
            'slug' => 'diagnostic-equipments',
            'active' => 1,
            'order' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $imagingId = DB::table('categories')->insertGetId([
            'parent_id' => $diagnosticParent,
            'name' => 'Diagnostic Imaging',
            'slug' => 'diagnostic-imaging',
            'active' => 1,
            'order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('categories')->insert([
            ['parent_id' => $diagnosticParent, 'name' => 'Laboratory Equipment', 'slug' => 'laboratory-equipment', 'active' => 1, 'order' => 2, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 3. Products
        // 01 High Frequency X-Ray Machine (500MA)
        DB::table('products')->insert([
            'category_id' => $imagingId,
            'title' => 'High Frequency X-Ray Machine (500MA)',
            'slug' => Str::slug('High Frequency X-Ray Machine (500MA)'),
            'brand' => 'DRGEM',
            'model' => 'GXRS',
            'origin' => 'Korea',
            'assembly' => 'Korea',
            'warranty' => '1 Year(Service+Spares)',
            'price' => 2250000.00,
            'installation_charge' => 15000.00,
            'short_description' => 'Premium floor mounted high frequency X-ray system.',
            'description' => 'Highly customizable digital diagnostic radiography system with dual speed rotor and premium upgrade options.',
            'features' => '<ul>
                <li>System concept: Premium floor mounted system</li>
                <li>Highly customizable digital diagnostic radiography system</li>
                <li>Auto-synchronization and auto-bucky tracking function</li>
                <li>Tube stand touch screen console for system, collimator, X-ray control and X-ray preview</li>
                <li>Elevating or floating table</li>
                <li>42KW Generator Full Auto mA calibration</li>
                <li>Adaptive mA calibration automatically compensates filament aging</li>
                <li>System diagnosis, Error log and Statistical data display</li>
                <li>Tube anode HU display & protection</li>
                <li>Dual speed starter: Direct drive by 6-pack IPM circuit</li>
            </ul>',
            'stock_status' => 'in_stock',
            'is_featured' => 1,
            'active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 02 Digital X-Ray System (Flat Pannel Ditector-FPD)
        DB::table('products')->insert([
            'category_id' => $imagingId,
            'title' => 'Digital X-Ray System (Flat Pannel Ditector-FPD)',
            'slug' => Str::slug('Digital X-Ray System (Flat Pannel Ditector-FPD)'),
            'brand' => 'PZ Medical',
            'model' => '4343A(White)',
            'origin' => 'Germany',
            'assembly' => 'Germany',
            'warranty' => '2 Years(service+Spare)',
            'price' => 1350000.00,
            'short_description' => 'High performance, cassette-sized flat panel detector.',
            'description' => 'Equipped with highly sensitive AED function, the detector can be easily connected to and synchronized with any kind of generators.',
            'features' => '<ul>
                <li>Detector Technology : a-Si</li>
                <li>Scintillator : Csl</li>
                <li>Image Size : 43x43cm(17x17in)</li>
                <li>Pixels Matrix : 3072x3072</li>
                <li>Pixel Pitch : 139μm</li>
                <li>A/D Conversion : 16bit</li>
                <li>Spatial Resolution : 3.6LP/mm</li>
                <li>Data Interface : GigE / 802.11ac</li>
                <li>Battery standby time : 10H(optional)</li>
                <li>Detector Housing Material : Carbon, Alloy</li>
                <li>Water tightness : IP54</li>
            </ul>',
            'stock_status' => 'in_stock',
            'is_featured' => 1,
            'active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 03 Computer Set + Printer
        DB::table('products')->insert([
            'category_id' => $imagingId,
            'title' => 'Computer Set & Carestream TX55 Laser Imager',
            'slug' => Str::slug('Computer Set & Carestream TX55 Laser Imager'),
            'brand' => 'Carestream',
            'model' => 'TX55',
            'origin' => 'USA',
            'assembly' => 'USA',
            'warranty' => '1 Year',
            'price' => 250000.00,
            'short_description' => 'Complete imaging workstation including CPU, Monitor, and Laser Printer.',
            'description' => 'Carestream’s TX55 laser imager enables the printing of high quality radiographic images.',
            'features' => '<ul>
                <li>Desktop CPU, Monitor, Keyboard, Mouse</li>
                <li>Image Quality Control (AIQC) technology</li>
                <li>Laser printing technique: thermal</li>
                <li>Accepts 125 film canisters</li>
                <li>Print capacity: up to 100 films per hour</li>
            </ul>',
            'stock_status' => 'in_stock',
            'is_featured' => 1,
            'active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->command->info('Categories and Products refreshed with complete hierarchy.');
    }
}
