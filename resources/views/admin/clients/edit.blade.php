@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Client</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Client Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $client->name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Order</label>
                                <input type="number" name="order" class="form-control" value="{{ $client->order }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Logo</label>
                                @if($client->logo)
                                    <div class="mb-2">
                                        <img src="{{ Str::startsWith($client->logo, 'http') ? $client->logo : Storage::url($client->logo) }}" height="50">
                                    </div>
                                @endif
                                <input type="file" name="logo" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-center">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" name="active" value="1" {{ $client->active ? 'checked' : '' }}>
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Client</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
