<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DOMDocument;
use DOMXPath;

class ScrapeMedisolve extends Command
{
    protected $signature = 'scrape:medisolve';
    protected $description = 'Scrape content from Medisolve.com.bd';

    public function handle()
    {
        $this->info('Starting Medisolve Scrape...');

        // Ensure directories exist
        if (!file_exists(public_path('uploads/products'))) {
            mkdir(public_path('uploads/products'), 0777, true);
        }
        if (!file_exists(public_path('uploads/categories'))) {
            mkdir(public_path('uploads/categories'), 0777, true);
        }

        $structure = [
            'Hospital Equipments' => [
                'Patient Monitor' => 'https://medisolve.com.bd/product/sub-category/patient-monitor',
                'OT Table' => 'https://medisolve.com.bd/product/sub-category/ot-table',
                'Anesthesia Machine' => 'https://medisolve.com.bd/product/sub-category/anesthesia-machine',
                'ECG Machine' => 'https://medisolve.com.bd/product/sub-category/ecg-machine',
                'Ultrasound Machine' => 'https://medisolve.com.bd/product/sub-category/ultrasound-machine',
                'X-Ray Machine' => 'https://medisolve.com.bd/product/sub-category/x-ray-machine',
                'CT- Scan Machine' => 'https://medisolve.com.bd/product/sub-category/ct-scan-machine',
                'OT Light' => 'https://medisolve.com.bd/product/sub-category/ot-light',
                'MRI' => 'https://medisolve.com.bd/product/sub-category/mri',
                'Diathermy' => 'https://medisolve.com.bd/product/sub-category/diathermy',
                'Cardiology' => 'https://medisolve.com.bd/product/sub-category/cardiology',
                'Autoclave' => 'https://medisolve.com.bd/product/sub-category/autoclave',
                'ICU' => 'https://medisolve.com.bd/product/sub-category/icu',
            ],
            'Diagnostic Equipments' => [
                'Biochemistry Analyzer' => 'https://medisolve.com.bd/product/sub-category/biochemistry-analyzer',
                'Microscope / Binocular' => 'https://medisolve.com.bd/product/sub-category/microscope-binocular',
                'Urine Analyzer' => 'https://medisolve.com.bd/product/sub-category/urine-analyzer',
                'Electrolyte Analyzer' => 'https://medisolve.com.bd/product/sub-category/electrolyte-analyzer',
                'Hematology Analyzer' => 'https://medisolve.com.bd/product/sub-category/hematology-analyzer',
                'Immunoassay Analyzer' => 'https://medisolve.com.bd/product/sub-category/immunoassay-analyzer',
                'Blood Gas Analyzer' => 'https://medisolve.com.bd/product/sub-category/blood-gas-analyzer',
                'Blood Culture Machine' => 'https://medisolve.com.bd/product/sub-category/blood-culture-machine',
                'Coagulation Analyzer' => 'https://medisolve.com.bd/product/sub-category/coagulation-analyzer',
                'Rapid Device' => 'https://medisolve.com.bd/product/sub-category/rapid-device',
                'Reagents' => 'https://medisolve.com.bd/product/sub-category/reagent',
                'ESR Analyzer' => 'https://medisolve.com.bd/product/sub-category/esr-analyzer',
                'Semen Analyzer' => 'https://medisolve.com.bd/product/sub-category/semen-analyzer',
                'Centrifuge' => 'https://medisolve.com.bd/product/sub-category/centrifuge',
                'Lab Rotator' => 'https://medisolve.com.bd/product/sub-category/lab-rotator',
                'PCR and RT-PCR' => 'https://medisolve.com.bd/product/sub-category/pcr-and-rt-pcr',
                'Colorimeter' => 'https://medisolve.com.bd/product/sub-category/colorimeter',
            ],
            'Hospital Consultancy' => [
                'Hospital Planning & Design' => 'https://medisolve.com.bd/product/sub-category/hospital-planning-design',
                'Hospital Management Consultancy' => 'https://medisolve.com.bd/product/sub-category/hospital-management-consultancy',
                'Hospital Operations & Finance' => 'https://medisolve.com.bd/product/sub-category/hospital-operations-finance',
                'Hospital Branding & Marketing' => 'https://medisolve.com.bd/product/sub-category/hospital-branding-marketing',
            ]
        ];

        foreach ($structure as $parentName => $subCategories) {
            $parent = Category::updateOrCreate(
                ['slug' => Str::slug($parentName)],
                ['name' => $parentName, 'active' => true]
            );

            $this->info("Processing Parent Category: $parentName");

            foreach ($subCategories as $subName => $url) {
                $subCategory = Category::updateOrCreate(
                    ['slug' => Str::slug($subName)],
                    ['name' => $subName, 'parent_id' => $parent->id, 'active' => true]
                );

                $this->info("  Processing Sub Category: $subName");
                $this->scrapeProducts($url, $subCategory);
            }
        }

        $this->info('Scraping Completed.');
    }

    protected function scrapeProducts($url, $category)
    {
        $response = Http::get($url);
        if ($response->failed()) {
            $this->error("Failed to fetch $url");
            return;
        }

        $html = $response->body();

        // Find product links - loose regex to capture standard looking product URLs
        preg_match_all('/<a[^>]+href="(https:\/\/medisolve\.com\.bd\/product\/[^"]+)"/i', $html, $matches);

        $productLinks = array_unique($matches[1]);
        $productLinks = array_filter($productLinks, fn($link) => !str_contains($link, '/sub-category/') && !str_contains($link, '/category/'));

        foreach ($productLinks as $link) {
            $this->scrapeProductDetail($link, $category);
        }
    }

    protected function scrapeProductDetail($url, $category)
    {
        $this->line("    Fetching Product: $url");
        try {
            $response = Http::timeout(30)->get($url);
            if ($response->failed())
                return;

            $html = $response->body();

            // Suppress DOM warnings
            libxml_use_internal_errors(true);
            $dom = new DOMDocument();
            $dom->loadHTML($html);
            $xpath = new DOMXPath($dom);

            // Title - typically <h1> or <title>
            $title = '';
            $h1 = $xpath->query('//h1'); // Assuming standard structure
            if ($h1->length > 0) {
                $title = trim($h1->item(0)->textContent);
            } else {
                // specific check for medisolve structure if H1 is generic
                // They often use a specific class or H2 in product detail
                $h2 = $xpath->query('//h2');
                if ($h2->length > 0)
                    $title = trim($h2->item(0)->textContent);
            }
            if (empty($title))
                return;


            // Image
            // Look for og:image or main product image
            $imageUrl = '';
            $metaImg = $xpath->query('//meta[@property="og:image"]');
            if ($metaImg->length > 0) {
                $imageUrl = $metaImg->item(0)->getAttribute('content');
            }

            // Download Image
            $localImage = null;
            if ($imageUrl && filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                $contents = Http::get($imageUrl)->body();
                $name = basename($imageUrl);
                // Ensure unique name
                $name = time() . '_' . $name;
                file_put_contents(public_path("uploads/products/{$name}"), $contents);
                $localImage = "uploads/products/{$name}";
            }

            // Description extraction
            // Simple extraction of body text roughly
            $description = '';
            // Try to find the container with content. Often 'col-md-9' or 'product-details' etc.
            // For now, let's grab the meta description or just leave it empty to avoid grabbing navigation garbage.
            // Be better: grab the entire body text after the title?
            // Let's use a regex to find the block "Key Features" or "Technical Specifications"

            preg_match('/(Key Features:.*?)(?:<footer|<div class="footer")/si', $html, $descMatch);
            if (isset($descMatch[1])) {
                $description = strip_tags($descMatch[1], '<p><br><ul><li><b><strong><table><tr><td><th>');
            }

            Product::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'category_id' => $category->id,
                    'description' => $description ?: 'Imported Product',
                    'image' => $localImage,
                    'price' => 0, // Request price
                    'active' => true,
                ]
            );

        } catch (\Exception $e) {
            $this->error("    Error scraping $url: " . $e->getMessage());
        }
    }
}
