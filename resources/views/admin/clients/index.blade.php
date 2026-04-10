@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Our Clients</h3>
                    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">Add Client</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Order</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr>
                                    <td>
                                        @if($client->logo)
                                            <img src="{{ Str::startsWith($client->logo, 'http') ? $client->logo : Storage::url($client->logo) }}" height="50">
                                        @endif
                                    </td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->order }}</td>
                                    <td>
                                        <span class="badge bg-{{ $client->active ? 'success' : 'danger' }}">
                                            {{ $client->active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
