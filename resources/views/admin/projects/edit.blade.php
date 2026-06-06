@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Edit Project</h3>
        </div>
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

            <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Client Name</label>
                        <input type="text" name="client_name" class="form-control" value="{{ $project->client_name }}">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ $project->description }}</textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">External URL</label>
                        <input type="url" name="url" class="form-control" value="{{ $project->url }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Completion Date</label>
                        <input type="date" name="completion_date" class="form-control" value="{{ $project->completion_date ? $project->completion_date->format('Y-m-d') : '' }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" name="order" class="form-control" value="{{ $project->order }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Technologies</label>
                    <input type="text" name="technologies" class="form-control" value="{{ $project->technologies ? implode(', ', $project->technologies) : '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Project Image</label>
                    @if($project->image)
                        <div class="mb-2">
                            <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : Storage::url($project->image) }}" height="100" class="rounded">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="active" class="form-check-input" id="active" value="1" {{ $project->active ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Active</label>
                </div>

                <button type="submit" class="btn btn-primary">Update Project</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
