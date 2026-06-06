<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('order')->paginate(50);
        $terms = \App\Models\TermAndCondition::where('is_active', true)->get();
        return view('admin.products.index', compact('products', 'terms'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'origin' => 'nullable|string|max:255',
            'assembly' => 'nullable|string|max:255',
            'warranty' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
            'catalog' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB PDF
            'stock_status' => 'required|string',
            'installation_charge' => 'nullable|numeric',
            'order' => 'integer',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['active'] = $request->has('active');
        $data['specifications'] = [];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('catalog')) {
            $data['catalog'] = $request->file('catalog')->store('catalogs', 'public');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products/gallery', 'public');
            }
        }
        $data['gallery'] = $galleryPaths;

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'origin' => 'nullable|string|max:255',
            'assembly' => 'nullable|string|max:255',
            'warranty' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
            'catalog' => 'nullable|file|mimes:pdf|max:10240',
            'stock_status' => 'required|string',
            'installation_charge' => 'nullable|numeric',
            'order' => 'integer',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_featured'] = $request->has('is_featured');
        $data['active'] = $request->has('active');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('catalog')) {
            if ($product->catalog) {
                Storage::disk('public')->delete($product->catalog);
            }
            $data['catalog'] = $request->file('catalog')->store('catalogs', 'public');
        }

        $currentGallery = $product->gallery ?? [];
        if ($request->has('delete_gallery')) {
            $toDelete = $request->input('delete_gallery');
            foreach ($toDelete as $path) {
                if (in_array($path, $currentGallery)) {
                    Storage::disk('public')->delete($path);
                    $currentGallery = array_values(array_diff($currentGallery, [$path]));
                }
            }
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $currentGallery[] = $file->store('products/gallery', 'public');
            }
        }
        $data['gallery'] = $currentGallery;

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        if ($product->catalog) {
            Storage::disk('public')->delete($product->catalog);
        }
        if (is_array($product->gallery)) {
            foreach ($product->gallery as $galleryImg) {
                Storage::disk('public')->delete($galleryImg);
            }
        }
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }
}
