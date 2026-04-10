@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Sliders</h2>
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">Add New Slider</a>
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Active</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td>{{ $slider->order }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider" height="50"
                                        class="rounded">
                                </td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->subtitle }}</td>
                                <td>
                                    <span class="badge bg-{{ $slider->active ? 'success' : 'secondary' }}">
                                        {{ $slider->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.sliders.edit', $slider) }}"
                                        class="btn btn-sm btn-info text-white">Edit</a>
                                    <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $sliders->links() }}
            </div>
        </div>
    </div>
@endsection