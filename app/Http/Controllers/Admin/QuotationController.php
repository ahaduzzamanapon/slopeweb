<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Quotation::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ref_id', 'LIKE', "%{$search}%")
                  ->orWhere('title', 'LIKE', "%{$search}%")
                  ->orWhere('client_name', 'LIKE', "%{$search}%")
                  ->orWhere('prepared_by', 'LIKE', "%{$search}%")
                  ->orWhereDate('created_at', 'LIKE', "%{$search}%");
            });
        }

        $quotations = $query->latest()->get();
        return view('admin.quotations.index', compact('quotations'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'product_ids'       => 'required|array',
            'product_ids.*'     => 'exists:products,id',
            'quantities'        => 'nullable|array',
            'prices'            => 'nullable|array',
            'quotation_title'   => 'nullable|string|max:255',
            'client_designation'=> 'nullable|string|max:255',
            'client_name'       => 'nullable|string|max:255',
            'client_address'    => 'nullable|string|max:500',
            'client_phone'      => 'nullable|string|max:50',
            'prepared_by'       => 'nullable|string|max:255',
        ]);

        $products  = \App\Models\Product::whereIn('id', $request->product_ids)->with('category')->get();
        
        // Map dynamic prices and quantities
        $products->map(function($product) use ($request) {
            $product->custom_quantity = $request->quantities[$product->id] ?? 1;
            $product->custom_price = $request->prices[$product->id] ?? $product->price;
            return $product;
        });

        $settings  = \App\Models\GeneralSetting::first() ?? new \App\Models\GeneralSetting();
        $termConditions = \App\Models\TermAndCondition::where('is_active', true)->get();

        // Auto-generate ref ID: Slope/Q-001/2026
        $lastId    = Quotation::max('id') ?? 0;
        $refId     = 'Slope/Q-' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT) . '/' . date('Y');

        $client = [
            'designation' => $request->client_designation ?: 'The Managing Director',
            'name'    => $request->client_name    ?? '[Client Hospital/Center Name]',
            'address' => $request->client_address ?? '[Client Address]',
            'phone'   => $request->client_phone   ?? '[Client Phone]',
        ];
        $preparedBy = $request->prepared_by ?? ($settings->md_name ?? 'Managing Director');

        $pdf      = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.quotation_bulk',
            compact('products', 'settings', 'client', 'preparedBy', 'refId', 'termConditions'));

        $title    = $request->quotation_title ?: 'Quotation-' . date('Ymd-His');
        $fileName = 'quotation_' . time() . '.pdf';

        \Illuminate\Support\Facades\Storage::disk('public')->put('quotations/' . $fileName, $pdf->output());

        Quotation::create([
            'title'         => $title,
            'file_path'     => 'quotations/' . $fileName,
            'ref_id'        => $refId,
            'client_name'   => $request->client_name,
            'client_address'=> $request->client_address,
            'client_phone'  => $request->client_phone,
            'prepared_by'   => $preparedBy,
        ]);

        return redirect()->route('admin.quotations.index')->with('success', 'Quotation ' . $refId . ' generated successfully.');
    }

    public function show(Quotation $quotation)
    {
        // Actually, we can either return the PDF view or download it directly
        return response()->download(storage_path('app/public/' . $quotation->file_path));
    }

    public function destroy(Quotation $quotation)
    {
        if ($quotation->file_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($quotation->file_path);
        }
        $quotation->delete();
        return redirect()->route('admin.quotations.index')->with('success', 'Quotation deleted successfully.');
    }
}
