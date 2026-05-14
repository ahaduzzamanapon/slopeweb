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
                                <td><input type="checkbox" name="product_ids[]" value="{{ $product->id }}" class="product-checkbox" data-title="{{ htmlentities($product->title) }}" data-price="{{ $product->price }}"></td>
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quotationModalLabel">Quotation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                <div class="row g-4">
                    <div class="col-lg-6 border-end">
                        <h6 class="fw-bold border-bottom pb-2 mb-3 text-primary"><i class="bi bi-person-lines-fill me-2"></i> Client Details</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-muted small text-uppercase mb-1">Quotation Title / Ref</label>
                                <input type="text" id="modal_quotation_title" class="form-control" placeholder="e.g. Hospital Equipment Quote">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small text-uppercase mb-1">To (Designation) <span class="text-danger">*</span></label>
                                <input type="text" id="modal_client_designation" class="form-control" placeholder="The Managing Director" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small text-uppercase mb-1">Client Name <span class="text-danger">*</span></label>
                                <input type="text" id="modal_client_name" class="form-control" placeholder="Hospital/Center" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small text-uppercase mb-1">Client Phone</label>
                                <input type="text" id="modal_client_phone" class="form-control" placeholder="+880...">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-muted small text-uppercase mb-1">Client Address</label>
                                <textarea id="modal_client_address" class="form-control" rows="2" placeholder="Full Address"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-muted small text-uppercase mb-1">Prepared By</label>
                                <input type="text" id="modal_prepared_by" class="form-control bg-light" value="{{ auth()->user()->name ?? (auth()->guard('admin')->user()->name ?? '') }}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <h6 class="fw-bold border-bottom pb-2 mb-3 text-primary"><i class="bi bi-box-seam me-2"></i> Selected Products</h6>
                        
                        <div class="table-responsive rounded border shadow-sm">
                            <table class="table table-sm table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-bottom-0 py-2">Product</th>
                                        <th width="120" class="border-bottom-0 py-2 text-center">Qty</th>
                                        <th width="180" class="border-bottom-0 py-2 text-end">Price</th>
                                    </tr>
                                </thead>
                                <tbody id="selected_products_tbody">
                                    <!-- Populated by JS -->
                                </tbody>
                            </table>
                        </div>
                        <small class="text-muted mt-2 d-block"><i class="bi bi-info-circle me-1"></i> You can adjust quantities and prices before generating.</small>
                    </div>
                </div>
                {{-- T&C Section --}}
                @if(isset($terms) && $terms->count())
                <div class="mt-4 pt-3 border-top">
                    <h6 class="fw-bold mb-3 text-primary"><i class="bi bi-card-list me-2"></i> Terms &amp; Conditions <small class="text-muted fw-normal">(uncheck to exclude from PDF)</small></h6>
                    <div class="row g-2">
                        @foreach($terms as $term)
                        <div class="col-md-6">
                            <div class="form-check border rounded-2 p-2 ps-4 bg-light">
                                <input class="form-check-input tc-check" type="checkbox" value="{{ $term->id }}" id="tc_{{ $term->id }}" checked>
                                <label class="form-check-label" for="tc_{{ $term->id }}">
                                    <span class="fw-semibold small">{{ $term->title }}</span>
                                    <span class="text-muted d-block" style="font-size:11px;">{{ Str::limit($term->content, 65) }}</span>
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
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
        const selected = document.querySelectorAll('.product-checkbox:checked');
        if (selected.length === 0) {
            alert('Please select at least one product.');
            return;
        }

        let tbody = document.getElementById('selected_products_tbody');
        tbody.innerHTML = '';
        
        selected.forEach(cb => {
            let title = cb.getAttribute('data-title');
            let price = cb.getAttribute('data-price') || 0;
            let id = cb.value;
            
            // Note: Since these inputs will be appended to DOM inside the modal,
            // they wouldn't naturally submit with the form if the modal is outside the form.
            // But wait! The modal is entirely *outside* the form. We need to handle this.
            tbody.innerHTML += `
                <tr>
                    <td class="fw-medium" title="${title}">${title}</td>
                    <td style="width: 120px;"><input type="number" id="qty_${id}" class="form-control text-center" value="1" min="1" style="width: 100%;"></td>
                    <td style="width: 180px;"><input type="number" id="price_${id}" step="0.01" class="form-control text-end" value="${price}" style="width: 100%;"></td>
                </tr>
            `;
        });

        quotationModal.show();
    });

    document.getElementById('confirmGenerate').addEventListener('click', function() {
        // Create hidden inputs for the extra fields
        const fields = {
            'quotation_title': 'modal_quotation_title',
            'client_designation': 'modal_client_designation',
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
        
        // Also add logic to capture dynamic quantity and prices from the modal
        const selected = document.querySelectorAll('.product-checkbox:checked');
        
        // Clean up any old dynamically added pricing hidden inputs in mainForm
        mainForm.querySelectorAll('.dynamic-qty-price').forEach(el => el.remove());
        
        selected.forEach(cb => {
            let id = cb.value;
            let qty = document.getElementById(`qty_${id}`).value;
            let price = document.getElementById(`price_${id}`).value;
            
            let hiddenQty = document.createElement('input');
            hiddenQty.type = 'hidden';
            hiddenQty.name = `quantities[${id}]`;
            hiddenQty.value = qty;
            hiddenQty.className = 'dynamic-qty-price';
            mainForm.appendChild(hiddenQty);
            
            let hiddenPrice = document.createElement('input');
            hiddenPrice.type = 'hidden';
            hiddenPrice.name = `prices[${id}]`;
            hiddenPrice.value = price;
            hiddenPrice.className = 'dynamic-qty-price';
            mainForm.appendChild(hiddenPrice);
        });

        // Capture selected term IDs
        mainForm.querySelectorAll('.dynamic-tc').forEach(el => el.remove());
        document.querySelectorAll('.tc-check:checked').forEach(cb => {
            let hiddenTc = document.createElement('input');
            hiddenTc.type = 'hidden';
            hiddenTc.name = 'term_ids[]';
            hiddenTc.value = cb.value;
            hiddenTc.className = 'dynamic-tc';
            mainForm.appendChild(hiddenTc);
        });

        if(!document.getElementById('modal_client_name').value) {
            alert('Client Name is required');
            return;
        }

        mainForm.submit();
    });
</script>
@endpush
@endsection
