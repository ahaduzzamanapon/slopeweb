@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Edit Terms & Conditions</h3>
        <a href="{{ route('admin.terms-and-conditions.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.terms-and-conditions.update', $terms_and_condition) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $terms_and_condition->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Terms Content (HTML Allowed) <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control" rows="10" required>{{ old('content', $terms_and_condition->content) }}</textarea>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                               {{ $terms_and_condition->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check-lg me-1"></i> Update Terms
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
