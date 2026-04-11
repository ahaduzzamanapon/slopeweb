@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Add Terms & Conditions</h3>
        <a href="{{ route('admin.terms-and-conditions.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.terms-and-conditions.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required placeholder="e.g. Standard Medical Terms">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Terms Content (HTML Allowed) <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control" rows="10" required>{{ old('content') }}</textarea>
                    <small class="text-muted">You can write terms as an HTML table or list here. It will be rendered exactly on the PDF.</small>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check-lg me-1"></i> Save Terms
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
