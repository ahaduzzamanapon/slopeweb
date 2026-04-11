@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Success Stories (Testimonials)</h3>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add Testimonial
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
                        <th style="width:70px">Avatar</th>
                        <th>Name / Title</th>
                        <th>Quote</th>
                        <th style="width:80px">Rating</th>
                        <th style="width:80px">Order</th>
                        <th style="width:80px">Status</th>
                        <th style="width:120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td>
                                @if($t->avatar)
                                    <img src="{{ str_starts_with($t->avatar, 'http') ? $t->avatar : Storage::url($t->avatar) }}"
                                         class="rounded-circle" width="45" height="45" style="object-fit:cover;">
                                @else
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold"
                                         style="width:45px;height:45px;">
                                        {{ strtoupper(substr($t->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $t->name }}</strong><br>
                                <small class="text-muted">{{ $t->title }}</small>
                            </td>
                            <td class="text-muted" style="max-width:300px;">
                                <span style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                    {{ $t->quote }}
                                </span>
                            </td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    <span style="color:{{ $i <= $t->rating ? '#f59e0b' : '#d1d5db' }};">★</span>
                                @endfor
                            </td>
                            <td>{{ $t->order }}</td>
                            <td>
                                <span class="badge {{ $t->active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $t->active ? 'Active' : 'Hidden' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this testimonial?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                No testimonials yet. <a href="{{ route('admin.testimonials.create') }}">Add one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
