@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Edit Testimonial</h3>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Title / Position</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $testimonial->title) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Quote / Testimonial <span class="text-danger">*</span></label>
                    <textarea name="quote" class="form-control" rows="4" required>{{ old('quote', $testimonial->quote) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Avatar Photo</label>
                        @if($testimonial->avatar)
                            <div class="mb-2">
                                <img src="{{ str_starts_with($testimonial->avatar, 'http') ? $testimonial->avatar : Storage::url($testimonial->avatar) }}"
                                     class="rounded-circle" width="60" height="60" style="object-fit:cover;">
                            </div>
                        @endif
                        <input type="file" name="avatar" class="form-control" accept="image/*">
                        <small class="text-muted">Leave blank to keep current.</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Rating</label>
                        <select name="rating" class="form-select">
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                                    {{ $i }} ★
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Display Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $testimonial->order) }}">
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="active" id="active"
                               {{ $testimonial->active ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">Active (visible on website)</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check-lg me-1"></i> Update Testimonial
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
