@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Contact Submissions</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="50">Status</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr class="{{ $contact->is_read ? '' : 'table-primary' }}">
                                <td>
                                    <span class="badge bg-{{ $contact->is_read ? 'secondary' : 'success' }}">
                                        {{ $contact->is_read ? 'Read' : 'New' }}
                                    </span>
                                </td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone ?? 'N/A' }}</td>
                                <td>{{ $contact->subject ?? 'N/A' }}</td>
                                <td>{{ $contact->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                                        data-bs-target="#contactModal{{ $contact->id }}">
                                        View
                                    </button>
                                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Contact Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <strong>Name:</strong> {{ $contact->name }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Email:</strong> {{ $contact->email }}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <strong>Phone:</strong> {{ $contact->phone ?? 'N/A' }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Subject:</strong> {{ $contact->subject ?? 'N/A' }}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Message:</strong>
                                                <p class="mt-2 p-3 bg-light rounded">{{ $contact->message }}</p>
                                            </div>
                                            <div>
                                                <strong>Submitted:</strong>
                                                {{ $contact->created_at->format('F d, Y \a\t H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
@endsection