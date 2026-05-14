<?php

namespace App\Http\Controllers;

use App\Models\CatalogueDownload;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CatalogueController extends Controller
{
    public function download(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:50',
        ]);

        CatalogueDownload::create([
            'name'  => $request->name,
            'phone' => $request->phone,
        ]);

        $settings = GeneralSetting::first();

        // Check if a catalogue PDF file exists in storage
        $cataloguePath = storage_path('app/public/catalogue/catalogue.pdf');
        if (file_exists($cataloguePath)) {
            return response()->download($cataloguePath, 'Slope-Medical-Catalogue.pdf');
        }

        // Fallback: generate a simple catalogue PDF
        $products = \App\Models\Product::where('active', true)->with('category')->orderBy('order')->get();
        $pdf = Pdf::loadView('pdf.catalogue', compact('settings', 'products'))->setPaper('a4');
        return $pdf->download('Slope-Medical-Catalogue.pdf');
    }
}
