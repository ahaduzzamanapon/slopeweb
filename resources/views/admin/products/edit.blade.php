@extends('admin.layouts.app')

@section('content')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Edit Product</h3>
        </div>
        <div class="card-body">
            <form id="productForm" action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ $product->title }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Installation Charge</label>
                        <input type="number" step="0.01" name="installation_charge" class="form-control" value="{{ $product->installation_charge }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Stock Status</label>
                        <select name="stock_status" class="form-select">
                            <option value="in_stock"    {{ $product->stock_status == 'in_stock'    ? 'selected' : '' }}>In Stock</option>
                            <option value="out_of_stock"{{ $product->stock_status == 'out_of_stock'? 'selected' : '' }}>Out of Stock</option>
                            <option value="pre_order"   {{ $product->stock_status == 'pre_order'   ? 'selected' : '' }}>Pre Order</option>
                        </select>
                    </div>
                </div>

                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Product Details</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" name="brand" class="form-control" value="{{ $product->brand }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Model</label>
                                <input type="text" name="model" class="form-control" value="{{ $product->model }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Warranty</label>
                                <input type="text" name="warranty" class="form-control" value="{{ $product->warranty }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Origin</label>
                                <input type="text" name="origin" class="form-control" value="{{ $product->origin }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Assembly</label>
                                <input type="text" name="assembly" class="form-control" value="{{ $product->assembly }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Special Features</label>
                    <div id="quill_features" style="height: 180px;"></div>
                    <textarea name="features" id="features_input" class="d-none">{!! $product->features !!}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Technical Description</label>
                    <div id="quill_short" style="height: 120px;"></div>
                    <textarea name="short_description" id="short_input" class="d-none">{!! $product->short_description !!}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Product Description</label>
                    <div id="quill_desc" style="height: 220px;"></div>
                    <textarea name="description" id="desc_input" class="d-none">{!! $product->description !!}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Main Product Image</label>
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : Storage::url($product->image) }}"
                                    height="100" class="rounded border">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Product Catalog (PDF)</label>
                        @if($product->catalog)
                            <div class="mb-2">
                                <a href="{{ Storage::url($product->catalog) }}" target="_blank"
                                    class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-file-pdf me-1"></i> View Current Catalog
                                </a>
                            </div>
                        @endif
                        <input type="file" name="catalog" class="form-control" accept=".pdf">
                    </div>
                </div>

                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Product Gallery Images</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Upload New Gallery Images</label>
                                <input type="file" name="gallery[]" class="form-control" multiple accept="image/*">
                                <small class="text-muted d-block mt-1">Select one or more images to append to the product gallery.</small>
                            </div>
                        </div>

                        @if($product->gallery && count($product->gallery) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label d-block">Current Gallery (Select to delete)</label>
                                    <div class="row g-2">
                                        @foreach($product->gallery as $galleryImg)
                                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                                <div class="position-relative border rounded p-1 bg-white">
                                                    <img src="{{ Storage::url($galleryImg) }}" class="img-fluid rounded" style="height: 100px; width: 100%; object-fit: cover;">
                                                    <div class="form-check position-absolute top-0 start-0 m-2 bg-white rounded px-2 py-1 shadow-sm">
                                                        <input type="checkbox" name="delete_gallery[]" value="{{ $galleryImg }}" class="form-check-input" id="del_gal_{{ $loop->index }}">
                                                        <label class="form-check-label text-danger font-monospace small" for="del_gal_{{ $loop->index }}">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-muted mb-0">No gallery images uploaded yet.</p>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Order</label>
                        <input type="number" name="order" class="form-control" value="{{ $product->order }}">
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="active" class="form-check-input" id="active" {{ $product->active ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" {{ $product->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Featured Product</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
<script>
    const toolbarOptions = [
        ['bold', 'italic', 'underline'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'size': ['small', false, 'large', 'huge'] }],
        ['clean']
    ];

    const qFeatures = new Quill('#quill_features', { theme: 'snow', modules: { toolbar: toolbarOptions } });
    const qShort    = new Quill('#quill_short',    { theme: 'snow', modules: { toolbar: toolbarOptions } });
    const qDesc     = new Quill('#quill_desc',     { theme: 'snow', modules: { toolbar: toolbarOptions } });

    // Pre-populate editors with existing data
    qFeatures.root.innerHTML = document.getElementById('features_input').value;
    qShort.root.innerHTML    = document.getElementById('short_input').value;
    qDesc.root.innerHTML     = document.getElementById('desc_input').value;

    document.getElementById('productForm').addEventListener('submit', function() {
        document.getElementById('features_input').value      = qFeatures.root.innerHTML;
        document.getElementById('short_input').value         = qShort.root.innerHTML;
        document.getElementById('desc_input').value          = qDesc.root.innerHTML;
    });
</script>
@endpush