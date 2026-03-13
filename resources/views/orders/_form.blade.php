@php
    $lineItems = old('items');

    if (!$lineItems && isset($order)) {
        $lineItems = $order->orderItems->map(function ($orderItem) {
            return [
                'item_id' => $orderItem->item_id,
                'quantity' => $orderItem->quantity,
                'item_notes' => $orderItem->item_notes,
                'item_status' => $orderItem->item_status,
            ];
        })->toArray();
    }

    $lineItems = $lineItems ?: [[
        'item_id' => '',
        'quantity' => 1,
        'item_notes' => '',
        'item_status' => 'pending',
    ]];

    $itemData = $items->map(fn ($item) => [
        'id' => $item->id,
        'name' => $item->name,
        'category' => $item->category,
        'price' => (float) $item->price,
        'is_available' => (bool) $item->is_available,
    ])->values();
@endphp

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" name="ordername" id="ordername"
                   class="form-control @error('ordername') is-invalid @enderror"
                   value="{{ old('ordername', $order->ordername ?? '') }}"
                   placeholder="Order Reference" required>
            <label for="ordername">
                <i class="fas fa-file-signature me-1"></i> Order Reference
            </label>
            @error('ordername')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <select name="customerno" id="customerno"
                    class="form-select @error('customerno') is-invalid @enderror" required>
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->customerno }}" {{ old('customerno', $order->customerno ?? '') == $customer->customerno ? 'selected' : '' }}>
                        {{ $customer->name }} ({{ $customer->customerno }})
                    </option>
                @endforeach
            </select>
            <label for="customerno">
                <i class="fas fa-user-tag me-1"></i> Customer
            </label>
            @error('customerno')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <select name="status" id="status"
                    class="form-select @error('status') is-invalid @enderror" required>
                @foreach (['pending' => 'Pending', 'processing' => 'Processing', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $value => $label)
                    <option value="{{ $value }}" {{ old('status', $order->status ?? 'pending') == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <label for="status">
                <i class="fas fa-info-circle me-1"></i> Order Status
            </label>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 bg-light h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <span class="text-muted text-uppercase small">Live Summary</span>
                <div class="d-flex justify-content-between mt-2">
                    <strong>Total Quantity</strong>
                    <strong id="summaryQuantity">{{ old('quantity', $order->quantity ?? 0) }}</strong>
                </div>
                <div class="d-flex justify-content-between mt-1">
                    <strong>Total Amount</strong>
                    <strong id="summaryAmount">Rs. {{ number_format(old('amount', $order->amount ?? 0), 2) }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card border-0 bg-light">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-bowl-food me-2 text-primary"></i>Order Items
                </h5>
                <button type="button" class="btn btn-primary btn-sm" id="addOrderItem">
                    <i class="fas fa-plus me-1"></i> Add Line
                </button>
            </div>
            <div class="card-body">
                @error('items')
                    <div class="alert alert-danger py-2">{{ $message }}</div>
                @enderror

                <div id="orderItemsWrapper" class="d-flex flex-column gap-3">
                    @foreach($lineItems as $index => $lineItem)
                        <div class="border rounded-3 p-3 order-item-row" data-index="{{ $index }}">
                            <div class="row g-3">
                                <div class="col-lg-4">
                                    <label class="form-label fw-semibold">Menu Item</label>
                                    <select name="items[{{ $index }}][item_id]" class="form-select item-select @error("items.$index.item_id") is-invalid @enderror" required>
                                        <option value="">Choose item</option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}"
                                                    data-price="{{ $item->price }}"
                                                    data-available="{{ $item->is_available ? '1' : '0' }}"
                                                    {{ (string) ($lineItem['item_id'] ?? '') === (string) $item->id ? 'selected' : '' }}>
                                                {{ $item->name }} - {{ $item->category }}{{ $item->is_available ? '' : ' (Out of Stock)' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error("items.$index.item_id")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-2">
                                    <label class="form-label fw-semibold">Qty</label>
                                    <input type="number" name="items[{{ $index }}][quantity]" class="form-control item-quantity @error("items.$index.quantity") is-invalid @enderror" min="1" max="50" value="{{ $lineItem['quantity'] ?? 1 }}" required>
                                    @error("items.$index.quantity")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-3">
                                    <label class="form-label fw-semibold">Item Status</label>
                                    <select name="items[{{ $index }}][item_status]" class="form-select @error("items.$index.item_status") is-invalid @enderror" required>
                                        @foreach (['pending' => 'Pending', 'preparing' => 'Preparing', 'ready' => 'Ready', 'served' => 'Served'] as $statusValue => $statusLabel)
                                            <option value="{{ $statusValue }}" {{ ($lineItem['item_status'] ?? 'pending') === $statusValue ? 'selected' : '' }}>{{ $statusLabel }}</option>
                                        @endforeach
                                    </select>
                                    @error("items.$index.item_status")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-3">
                                    <label class="form-label fw-semibold">Line Total</label>
                                    <div class="form-control bg-white item-line-total">Rs. 0.00</div>
                                </div>

                                <div class="col-lg-10">
                                    <label class="form-label fw-semibold">Customization / Notes</label>
                                    <input type="text" name="items[{{ $index }}][item_notes]" class="form-control @error("items.$index.item_notes") is-invalid @enderror" value="{{ $lineItem['item_notes'] ?? '' }}" placeholder="Example: Extra cheese, no onion">
                                    @error("items.$index.item_notes")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-outline-danger w-100 remove-order-item" {{ count($lineItems) === 1 ? 'disabled' : '' }}>
                                        <i class="fas fa-trash-alt me-1"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-floating">
            <textarea name="notes" id="notes"
                      class="form-control @error('notes') is-invalid @enderror"
                      placeholder="Order Notes"
                      style="height: 100px">{{ old('notes', $order->notes ?? '') }}</textarea>
            <label for="notes">
                <i class="fas fa-sticky-note me-1"></i> Special Instructions
            </label>
            @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="d-flex justify-content-between border-top pt-3">
    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> {{ $cancelLabel ?? 'Cancel' }}
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> {{ $submitLabel }}
    </button>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const items = @json($itemData);
        const wrapper = document.getElementById('orderItemsWrapper');
        const addButton = document.getElementById('addOrderItem');
        const quantitySummary = document.getElementById('summaryQuantity');
        const amountSummary = document.getElementById('summaryAmount');

        const buildOptions = (selected = '') => {
            const options = ['<option value="">Choose item</option>'];

            items.forEach(item => {
                const selectedAttr = String(item.id) === String(selected) ? 'selected' : '';
                const availabilityLabel = item.is_available ? '' : ' (Out of Stock)';
                options.push(`<option value="${item.id}" data-price="${item.price}" data-available="${item.is_available ? 1 : 0}" ${selectedAttr}>${item.name} - ${item.category}${availabilityLabel}</option>`);
            });

            return options.join('');
        };

        const createRow = (index, values = {}) => `
            <div class="border rounded-3 p-3 order-item-row" data-index="${index}">
                <div class="row g-3">
                    <div class="col-lg-4">
                        <label class="form-label fw-semibold">Menu Item</label>
                        <select name="items[${index}][item_id]" class="form-select item-select" required>
                            ${buildOptions(values.item_id || '')}
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <label class="form-label fw-semibold">Qty</label>
                        <input type="number" name="items[${index}][quantity]" class="form-control item-quantity" min="1" max="50" value="${values.quantity || 1}" required>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label fw-semibold">Item Status</label>
                        <select name="items[${index}][item_status]" class="form-select" required>
                            <option value="pending" ${values.item_status === 'pending' || !values.item_status ? 'selected' : ''}>Pending</option>
                            <option value="preparing" ${values.item_status === 'preparing' ? 'selected' : ''}>Preparing</option>
                            <option value="ready" ${values.item_status === 'ready' ? 'selected' : ''}>Ready</option>
                            <option value="served" ${values.item_status === 'served' ? 'selected' : ''}>Served</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label fw-semibold">Line Total</label>
                        <div class="form-control bg-white item-line-total">Rs. 0.00</div>
                    </div>
                    <div class="col-lg-10">
                        <label class="form-label fw-semibold">Customization / Notes</label>
                        <input type="text" name="items[${index}][item_notes]" class="form-control" value="${values.item_notes || ''}" placeholder="Example: Extra cheese, no onion">
                    </div>
                    <div class="col-lg-2 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger w-100 remove-order-item">
                            <i class="fas fa-trash-alt me-1"></i> Remove
                        </button>
                    </div>
                </div>
            </div>`;

        const updateSummaries = () => {
            let totalQty = 0;
            let totalAmount = 0;

            wrapper.querySelectorAll('.order-item-row').forEach(row => {
                const select = row.querySelector('.item-select');
                const quantity = Number(row.querySelector('.item-quantity').value || 0);
                const option = select.options[select.selectedIndex];
                const price = Number(option?.dataset.price || 0);
                const lineTotal = quantity * price;

                row.querySelector('.item-line-total').textContent = `Rs. ${lineTotal.toFixed(2)}`;

                totalQty += quantity;
                totalAmount += lineTotal;
            });

            quantitySummary.textContent = totalQty;
            amountSummary.textContent = `Rs. ${totalAmount.toFixed(2)}`;

            const removeButtons = wrapper.querySelectorAll('.remove-order-item');
            removeButtons.forEach(button => {
                button.disabled = removeButtons.length === 1;
            });
        };

        const nextIndex = () => wrapper.querySelectorAll('.order-item-row').length;

        addButton.addEventListener('click', function () {
            wrapper.insertAdjacentHTML('beforeend', createRow(nextIndex()));
            updateSummaries();
        });

        wrapper.addEventListener('click', function (event) {
            const removeButton = event.target.closest('.remove-order-item');

            if (!removeButton) {
                return;
            }

            removeButton.closest('.order-item-row').remove();
            updateSummaries();
        });

        wrapper.addEventListener('change', updateSummaries);
        wrapper.addEventListener('input', updateSummaries);

        updateSummaries();
    });
</script>
@endpush
