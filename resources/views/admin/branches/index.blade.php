@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Branches</h2>
        <a href="{{ route('admin.branches.create') }}" class="btn btn-primary">Add New Branch</a>
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
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Order</th>
                        <th>Active</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branches as $branch)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">
                                @if($branch->logo)
                                    <img src="{{ asset('storage/'.$branch->logo) }}" alt="Logo" style="height:32px;margin-right:6px;border-radius:4px;">
                                @endif
                                {{ $branch->name }}
                            </td>
                            <td>{{ $branch->phone }}</td>
                            <td>{{ Str::limit($branch->address, 50) }}</td>
                            <td>{{ $branch->order }}</td>
                            <td>
                                <span class="badge bg-{{ $branch->active ? 'success' : 'secondary' }}">
                                    {{ $branch->active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.branches.edit', $branch) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                <form action="{{ route('admin.branches.destroy', $branch) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this branch?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($branches->isEmpty())
                        <tr><td colspan="7" class="text-center">No branches found.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $branches->links() }}</div>
    </div>
</div>
@endsection
