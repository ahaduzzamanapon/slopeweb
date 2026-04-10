@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Edit Service</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $service->title }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ $service->description }}</textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Icon</label>
                        <input type="text" name="icon" class="form-control" value="{{ $service->icon }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" name="order" class="form-control" value="{{ $service->order }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    @if($service->image)
                        <div class="mb-2">
                            <img src="{{ Str::startsWith($service->image, 'http') ? $service->image : Storage::url($service->image) }}" height="50" class="rounded">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="active" class="form-check-input" id="active" {{ $service->active ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Active</label>
                </div>

                <button type="submit" class="btn btn-primary">Update Service</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
