@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Edit Category</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" value="{{ $category->order }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    @if($category->image)
                        <div class="mb-2">
                            <img src="{{ Str::startsWith($category->image, 'http') ? $category->image : Storage::url($category->image) }}" height="50" class="rounded">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="active" class="form-check-input" id="active" {{ $category->active ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Active</label>
                </div>

                <button type="submit" class="btn btn-primary">Update Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
