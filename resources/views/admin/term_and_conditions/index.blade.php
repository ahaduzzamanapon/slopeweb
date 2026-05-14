@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Terms & Conditions</h3>
        <a href="{{ route('admin.terms-and-conditions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Terms
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:60px">#</th>
                        <th style="width:200px">Title</th>
                        <th>Terms Content (HTML)</th>
                        <th style="width:100px">Status</th>
                        <th style="width:150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($terms as $term)
                        <tr>
                            <td>{{ $term->id }}</td>
                            <td><strong>{{ $term->title }}</strong></td>
                            <td>
                                <div style="max-height: 80px; overflow-y: auto; font-size: 12px; background: #f8f9fa; padding: 8px; border-radius: 4px; border: 1px solid #dee2e6;">
                                    {!! $term->content !!}
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $term->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $term->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.terms-and-conditions.edit', $term) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.terms-and-conditions.destroy', $term) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete these terms?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                No Terms & Conditions found. <a href="{{ route('admin.terms-and-conditions.create') }}">Add one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
