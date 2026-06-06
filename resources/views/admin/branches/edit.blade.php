@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Branch</h2>
        <a href="{{ route('admin.branches.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.branches.update', $branch) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Branch Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $branch->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $branch->phone) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $branch->email) }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Address</label>
                        <textarea name="address" class="form-control" rows="2">{{ old('address', $branch->address) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Logo / Image</label>
                        @if($branch->logo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$branch->logo) }}" alt="Logo" style="height:60px;border-radius:6px;border:1px solid #ddd;padding:4px;">
                            </div>
                        @endif
                        <input type="file" name="logo" class="form-control" accept="image/*">
                        <small class="text-muted">Leave blank to keep current logo.</small>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $branch->order) }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-center pt-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ $branch->active ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="active">Active</label>
                        </div>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Update Branch</button>
            </form>
        </div>
    </div>
</div>
@endsection
