@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Team Member</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $team->name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" name="designation" class="form-control" value="{{ $team->designation }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-select" required>
                                    <option value="management" {{ $team->type == 'management' ? 'selected' : '' }}>Management</option>
                                    <option value="engineer" {{ $team->type == 'engineer' ? 'selected' : '' }}>Engineer</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Order</label>
                                <input type="number" name="order" class="form-control" value="{{ $team->order }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Image</label>
                                @if($team->image)
                                    <div class="mb-2">
                                        <img src="{{ Str::startsWith($team->image, 'http') ? $team->image : Storage::url($team->image) }}" height="50">
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-center">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" name="active" value="1" {{ $team->active ? 'checked' : '' }}>
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Member</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
