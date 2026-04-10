@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Add Product</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Installation Charge</label>
                        <input type="number" step="0.01" name="installation_charge" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stock Status</label>
                        <select name="stock_status" class="form-select">
                            <option value="in_stock">In Stock</option>
                            <option value="out_of_stock">Out of Stock</option>
                            <option value="pre_order">Pre Order</option>
                        </select>
                    </div>
            </div>

            <div class="card bg-light mb-3">
                <div class="card-body">
                    <h5 class="card-title">Product Details</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Model</label>
                            <input type="text" name="model" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Warranty</label>
                            <input type="text" name="warranty" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Origin</label>
                            <input type="text" name="origin" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Assembly</label>
                            <input type="text" name="assembly" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Features (Bullet Points)</label>
                <textarea name="features" class="form-control" rows="4"
                    placeholder="Enter features (one per line or HTML bullet points)"></textarea>
                <div class="form-text">You can use HTML &lt;li&gt; tags or just list items.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Short Description</label>
                <textarea name="short_description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Full Description</label>
                <textarea name="description" class="form-control" rows="6"></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Product Catalog (PDF)</label>
                    <input type="file" name="catalog" class="form-control" accept=".pdf">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="active" class="form-check-input" id="active" checked>
                    <label class="form-check-label" for="active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured">
                    <label class="form-check-label" for="is_featured">Featured Product</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
    </div>
@endsection