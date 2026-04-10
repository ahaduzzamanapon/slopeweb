@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Generated Quotations</h2>
        <div class="d-flex gap-2">
            <form action="{{ route('admin.quotations.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search Ref, Title, Client..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Search</button>
                @if(request('search'))
                    <a href="{{ route('admin.quotations.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </form>
            <a href="{{ route('admin.products.index') }}" class="btn btn-warning">Generate New from Products</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Ref ID</th>
                        <th>Title</th>
                        <th>Client</th>
                        <th>Prepared By</th>
                        <th>Date generated</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quotations as $quotation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $quotation->ref_id }}</td>
                            <td>{{ $quotation->title }}</td>
                            <td>{{ $quotation->client_name }}</td>
                            <td>{{ $quotation->prepared_by }}</td>
                            <td>{{ $quotation->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $quotation->file_path) }}" target="_blank" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i> View PDF
                                </a>
                                <form action="{{ route('admin.quotations.destroy', $quotation) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($quotations->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No quotations generated yet.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
