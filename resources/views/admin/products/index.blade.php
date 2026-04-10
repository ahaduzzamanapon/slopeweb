@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Products</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.quotations.generate') }}" method="POST">
        @csrf
    <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Product List</h5>
                <div>
                    <button type="button" class="btn btn-warning" id="openQuotationModal">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Generate Quotation
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="40"><input type="checkbox" id="selectAll"></th>
                            <th width="50">#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Active</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><input type="checkbox" name="product_ids[]" value="{{ $product->id }}" class="product-checkbox"></td>
                                <td>{{ $product->order }}</td>
                                <td>
                                    {{ $product->title }}
                                    @if($product->is_featured)
                                        <span class="badge bg-warning text-dark ms-1">Featured</span>
                                    @endif
                                </td>
                                <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $product->stock_status)) }}</td>
                                <td>
                                    <span class="badge bg-{{ $product->active ? 'success' : 'secondary' }}">
                                        {{ $product->active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                    <!-- Using an independent form for the delete button via form attribute, as nested forms are forbidden -->
                                    <button form="delete-form-{{ $product->id }}" type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        </div>
    </form>

    <!-- Delete Forms -->
    @foreach($products as $product)
    @endforeach
</div>

{{-- Quotation Info Modal --}}
<div class="modal fade" id="quotationModal" tabindex="-1" aria-labelledby="quotationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quotationModalLabel">Quotation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Quotation Title (Internal)</label>
                    <input type="text" id="modal_quotation_title" class="form-control" placeholder="e.g. Hospital Equipment Quote">
                </div>
                <div class="mb-3">
                    <label class="form-label">Client/Hospital Name</label>
                    <input type="text" id="modal_client_name" class="form-control" placeholder="[Client Hospital/Center Name]" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Client Address</label>
                    <textarea id="modal_client_address" class="form-control" rows="2" placeholder="[Client Address]"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Client Phone</label>
                    <input type="text" id="modal_client_phone" class="form-control" placeholder="[Client Phone]">
                </div>
                <div class="mb-3">
                    <label class="form-label">Prepared By</label>
                    <input type="text" id="modal_prepared_by" class="form-control" value="{{ auth()->user()->name ?? (auth()->guard('admin')->user()->name ?? (\App\Models\GeneralSetting::first()->md_name ?? '')) }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmGenerate">Generate PDF</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.product-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    const quotationModal = new bootstrap.Modal(document.getElementById('quotationModal'));
    const mainForm = document.querySelector('form[action="{{ route("admin.quotations.generate") }}"]');

    document.getElementById('openQuotationModal').addEventListener('click', function() {
        const selected = document.querySelectorAll('.product-checkbox:checked').length;
        if (selected === 0) {
            alert('Please select at least one product.');
            return;
        }
        quotationModal.show();
    });

    document.getElementById('confirmGenerate').addEventListener('click', function() {
        // Create hidden inputs for the extra fields
        const fields = {
            'quotation_title': 'modal_quotation_title',
            'client_name': 'modal_client_name',
            'client_address': 'modal_client_address',
            'client_phone': 'modal_client_phone',
            'prepared_by': 'modal_prepared_by'
        };

        for (const [name, id] of Object.entries(fields)) {
            const val = document.getElementById(id).value;
            let hidden = mainForm.querySelector(`input[name="${name}"]`);
            if (!hidden) {
                hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = name;
                mainForm.appendChild(hidden);
            }
            hidden.value = val;
        }

        if(!document.getElementById('modal_client_name').value) {
            alert('Client Name is required');
            return;
        }

        mainForm.submit();
    });
</script>
@endpush
@endsection
