@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Add Testimonial</h3>
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

            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Dr. Ahmed Zubair">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Title / Position</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Director, Central Hospital">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Quote / Testimonial <span class="text-danger">*</span></label>
                    <textarea name="quote" class="form-control" rows="4" required
                        placeholder="Write the testimonial text here...">{{ old('quote') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Avatar Photo</label>
                        <input type="file" name="avatar" class="form-control" accept="image/*">
                        <small class="text-muted">Max 2MB. Leave blank to use initials.</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Rating</label>
                        <select name="rating" class="form-select">
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>
                                    {{ $i }} ★
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Display Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="active" id="active" checked>
                        <label class="form-check-label" for="active">Active (visible on website)</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check-lg me-1"></i> Save Testimonial
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
