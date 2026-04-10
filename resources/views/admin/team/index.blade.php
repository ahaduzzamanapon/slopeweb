@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Team Members</h3>
                    <a href="{{ route('admin.team.create') }}" class="btn btn-primary">Add Member</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Type</th>
                                    <th>Order</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($team as $member)
                                <tr>
                                    <td>
                                        @if($member->image)
                                            <img src="{{ Str::startsWith($member->image, 'http') ? $member->image : Storage::url($member->image) }}" height="50">
                                        @endif
                                    </td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->designation }}</td>
                                    <td>{{ ucfirst($member->type) }}</td>
                                    <td>{{ $member->order }}</td>
                                    <td>
                                        <span class="badge bg-{{ $member->active ? 'success' : 'danger' }}">
                                            {{ $member->active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.team.edit', $member->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" class="d-inline">
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
