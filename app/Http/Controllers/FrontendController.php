<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FrontendController extends Controller
{
    public function index()
    {
        $settings = GeneralSetting::first() ?? new GeneralSetting();

        $categories = Category::where('active', true)
            ->orderBy('order')
            ->get();

        $featuredProducts = Product::where('active', true)
            ->where('is_featured', true)
            ->with('category')
            ->orderBy('order')
            ->limit(8)
            ->get();

        // Fallback: if no featured products, show all active products
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::where('active', true)
                ->with('category')
                ->orderBy('order')
                ->limit(8)
                ->get();
        }

        $sliders      = \App\Models\Slider::where('active', true)->orderBy('order')->get();
        $services     = \App\Models\Service::where('active', true)->orderBy('order')->limit(4)->get();
        $testimonials = \App\Models\Testimonial::where('active', true)->orderBy('order')->get();
        $clients      = \App\Models\Client::where('active', true)->orderBy('order')->get();

        return view('frontend.home', compact('settings', 'categories', 'featuredProducts', 'sliders', 'services', 'testimonials', 'clients'));
    }
    public function productsIndex(Request $request)
    {
        $settings = GeneralSetting::first() ?? new GeneralSetting();
        $allCategories = Category::whereNull('parent_id')->with('children')->orderBy('name')->get();

        $query = Product::where('active', true)->with('category')->orderBy('order');

        $activeCategory = null;
        if ($request->has('category')) {
            $cat = Category::where('slug', $request->category)
                ->orWhere('id', $request->category)
                ->first();
            if ($cat) {
                $activeCategory = $cat;
                // Include children products too
                $catIds = [$cat->id];
                if ($cat->children) {
                    $catIds = array_merge($catIds, $cat->children->pluck('id')->toArray());
                }
                $query->whereIn('category_id', $catIds);
            }
        }

        $products = $query->paginate(16);

        return view('frontend.products.index', compact('settings', 'products', 'allCategories', 'activeCategory'));
    }

    public function product($slug)
    {
        $settings = GeneralSetting::first() ?? new GeneralSetting();
        $product = Product::where('slug', $slug)->where('active', true)->with('category')->firstOrFail();

        return view('frontend.products.show', compact('settings', 'product'));
    }

    public function downloadQuotation($slug)
    {
        $settings = GeneralSetting::first() ?? new GeneralSetting();
        $product = Product::where('slug', $slug)->where('active', true)->with('category')->firstOrFail();

        $pdf = Pdf::loadView('pdf.quotation', compact('settings', 'product'));

        // Setup filename
        $filename = 'Quotation-' . str_replace(' ', '-', $product->title) . '-' . date('d.m.Y') . '.pdf';

        return $pdf->download($filename);
    }
}
