@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Catalog Downloads Log</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Downloaded Product Catalog</th>
                            <th>Date & Time</th>
                            <th width="100">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($downloads as $download)
                            <tr>
                                <td>{{ $download->name }}</td>
                                <td>{{ $download->phone }}</td>
                                <td>
                                    @if($download->product)
                                        <a href="{{ route('admin.products.edit', $download->product) }}" class="fw-bold text-decoration-none">
                                            {{ $download->product->title }}
                                        </a>
                                    @else
                                        <span class="text-muted">General Slope Catalogue</span>
                                    @endif
                                </td>
                                <td>{{ $download->created_at->format('M d, Y H:i:s') }} ({{ $download->created_at->diffForHumans() }})</td>
                                <td>
                                    <form action="{{ route('admin.catalogue-downloads.destroy', $download) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this log entry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    No catalog download submissions recorded yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($downloads->hasPages())
                <div class="card-footer">
                    {{ $downloads->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
