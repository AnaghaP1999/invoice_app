<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-7xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Update Invoice') }}
                            </h2>
                        </header>
                        <form method="POST" action="{{ route('generate-invoice') }}" id="invoiceForm" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$id}}">
                            <div class="flex flex-wrap -mx-4">
                                <div class="w-1/2 px-4">
                                    <x-input-label for="quantity" :value="__('Quantity')" />
                                    <x-text-input id="quantity" name="quantity" type="text" class="mt-1 block w-full" placeholder="Quantity" value="{{ old('quantity') }}" value="{{ $invoiceDetails->quantity}}"/>
                                    @error('quantity')
                                        <span class="error" id="quantity-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-1/2 px-4">
                                    <x-input-label for="amount" :value="__('Amount')" />
                                    <x-text-input id="amount" name="amount" type="text" class="mt-1 block w-full" placeholder="Amount" value="{{ old('amount') }}" value="{{ $invoiceDetails->amount}}"/>
                                    @error('amount')
                                        <span class="error" id="amount-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-1/2 px-4">
                                    <x-input-label for="total_amount" :value="__('Total Amount')" />
                                    <x-text-input id="total_amount" name="total_amount" type="text" class="mt-1 block w-full" placeholder="Total Amount" value="{{ old('total_amount') }}" value="{{ $invoiceDetails->total_amount}}" readonly/>
                                </div>

                                <div class="w-1/2 px-4">
                                    <x-input-label for="tax_perc" :value="__('Tax Percentage')"/>
                                        <select id="tax_perc" name="tax_perc" class="mt-1 block w-1/2">
                                            <option value="">Select Option</option>
                                            <option value="0" {{ old('tax_perc') == '0' ? 'selected' : '' }} {{ $invoiceDetails->tax_perc == 0 ? 'selected' : '' }}>0%</option>
                                            <option value="5" {{ old('tax_perc') == '5' ? 'selected' : '' }} {{ $invoiceDetails->tax_perc == 5 ? 'selected' : '' }}>5%</option>
                                            <option value="12" {{ old('tax_perc') == '12' ? 'selected' : '' }} {{ $invoiceDetails->tax_perc == 12 ? 'selected' : '' }}>12%</option>
                                            <option value="18" {{ old('tax_perc') == '18' ? 'selected' : '' }} {{ $invoiceDetails->tax_perc == 18 ? 'selected' : '' }}>18%</option>
                                            <option value="28" {{ old('tax_perc') == '28' ? 'selected' : '' }} {{ $invoiceDetails->tax_perc == 28 ? 'selected' : '' }}>28%</option>
                                        </select>
                                        @error('tax_perc')
                                        <span class="error" id="tax_perc-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                        @enderror
                                </div>

                                <div class="w-1/2 px-4">
                                    <x-input-label for="tax_amount" :value="__('Tax Amount')" />
                                    <x-text-input id="tax_amount" name="tax_amount" type="text" class="mt-1 block w-full" placeholder="Tax Amount" value="{{ old('tax_amount') }}" value="{{ $invoiceDetails->tax_amount}}" readonly/>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-4">
                                <div class="w-1/2 px-4">
                                    <x-input-label for="net_amount" :value="__('Net Amount')" />
                                    <x-text-input id="net_amount" name="net_amount" type="text" class="mt-1 block w-full" placeholder="Net Amount" value="{{ old('net_amount') }}" value="{{ $invoiceDetails->net_amount}}" readonly/>
                                </div>

                                <div class="w-1/2 px-4">
                                    <x-input-label for="customer_name" :value="__('Customer Name')" />
                                    <x-text-input id="customer_name" name="customer_name" type="text" class="mt-1 block w-full" placeholder="Customer Name" value="{{ old('customer_name') }}" value="{{ $invoiceDetails->customer_name}}"/>
                                    @error('customer_name')
                                        <span class="error" id="customer_name-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-1/2 px-4">
                                    <x-input-label for="invoice_date" :value="__('Invoice Date')" />
                                    <x-text-input id="invoice_date" name="invoice_date" type="date" class="mt-1 block w-full" placeholder="Invoice Date" value="{{ old('invoice_date') }}" value="{{ $invoiceDetails->invoice_date}}"/>
                                    @error('invoice_date')
                                        <span class="error" id="invoice_date-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="w-1/2 px-4">
                                    <x-input-label for="customer_email" :value="__('Customer Email')" />
                                    <x-text-input id="customer_email" name="customer_email" type="email" class="mt-1 block w-full" placeholder="Customer Email" value="{{ old('customer_email') }}" value="{{ $invoiceDetails->customer_email}}"/>
                                    @error('customer_email')
                                        <span class="error" id="customer_email-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-4">
                                <div class="w-1/2 px-4">
                                    <x-input-label for="image" :value="__('Upload File')" />
                                    <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" placeholder="Upload File" accept="image/*,application/pdf" data-is-updating value="{{ old('image') }}" value="{{ $invoiceDetails->image}}"/>
                                    @error('image')
                                        <span class="error" id="image-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-1/2 px-4">
                                    @if ($invoiceDetails->image)
                                        <p style="color: white;">Previously Uploaded File:</p>
                                        <a style="color: white;" href="{{ route('files.show', ['filename' => $invoiceDetails->image]) }}" target="_blank">View File</a>
                                    @endif
                                </div>
                            </div>   
                            <div class="flex items-center gap-4">
                                <x-primary-button type="submit">{{ __('Update') }}</x-primary-button>
                                <x-primary-button id="cancel-button" type="button">{{ __('Cancel') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

<script>
    
// Amount Calculation
document.addEventListener('input', function (e) {
    if (e.target.name === 'quantity' || e.target.name === 'amount') {
        const quantity = parseFloat(document.querySelector('#quantity').value);
        const amount = parseFloat(document.querySelector('#amount').value);
        const totalAmount = isNaN(quantity) || isNaN(amount) ? '' : quantity * amount;
        document.querySelector('#total_amount').value = totalAmount;

        // Calculate taxAmount here
        const taxPerc = parseFloat(document.querySelector('#tax_perc').value);
        const taxAmount = isNaN(totalAmount) || isNaN(taxPerc) ? '' : (totalAmount * taxPerc) / 100;
        document.querySelector('#tax_amount').value = taxAmount;
    } else if (e.target.name === 'tax_perc') {
        const totalAmount = parseFloat(document.querySelector('#total_amount').value);
        const taxPerc = parseFloat(document.querySelector('#tax_perc').value);
        const taxAmount = isNaN(totalAmount) || isNaN(taxPerc) ? '' : (totalAmount * taxPerc) / 100;
        document.querySelector('#tax_amount').value = taxAmount;
    }
    
    const totalAmount = parseFloat(document.querySelector('#total_amount').value);
    const taxAmount = parseFloat(document.querySelector('#tax_amount').value);
    const netAmount = isNaN(totalAmount) || isNaN(taxAmount) ? '' : totalAmount + taxAmount;
    document.querySelector('#net_amount').value = netAmount;
});


// Validate each input field
$(document).ready(function() {
    $('#invoiceForm').submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting
        $('.error').remove(); // Clear previous error messages
        var errors = 0;

        if ($('#quantity').val() === '') {
            $('#quantity').after('<span class="error">Quantity is required</span>');
            errors++;
        } else if (!$.isNumeric($('#quantity').val())) {
            $('#quantity').after('<span class="error">Quantity must be a number</span>');
            errors++;
        }

        if ($('#amount').val() === '') {
            $('#amount').after('<span class="error">Amount is required</span>');
            errors++;
        } else if (!$.isNumeric($('#amount').val())) {
            $('#amount').after('<span class="error">Amount must be a number</span>');
            errors++;
        }

        if ($('#total_amount').val() === '') {
            $('#total_amount').after('<span class="error">Total Amount is required</span>');
            errors++;
        } else if (!$.isNumeric($('#total_amount').val())) {
            $('#total_amount').after('<span class="error">Total Amount must be a number</span>');
            errors++;
        }

        if ($('#net_amount').val() === '') {
            $('#net_amount').after('<span class="error">Net Amount is required</span>');
            errors++;
        } else if (!$.isNumeric($('#net_amount').val())) {
            $('#net_amount').after('<span class="error">Net Amount must be a number</span>');
            errors++;
        }

        if ($('#tax_amount').val() === '') {
            $('#tax_amount').after('<span class="error">Tax Amount is required</span>');
            errors++;
        } else if (!$.isNumeric($('#tax_amount').val())) {
            $('#tax_amount').after('<span class="error">Tax Amount must be a number</span>');
            errors++;
        }

        if ($('#tax_perc').val() === '') {
            $('#tax_perc').after('<span class="error">Tax Percentage is required</span>');
            errors++;
        }

        if ($('#customer_name').val() === '') {
            $('#customer_name').after('<span class="error">Customer Name is required</span>');
            errors++;
        } else if (!/^[A-Za-z\s]+$/.test($('#customer_name').val())) {
            $('#customer_name').after('<span class="error">Customer Name should only contain letters and spaces</span>');
            errors++;
        }

        if ($('#invoice_date').val() === '') {
            $('#invoice_date').after('<span class="error">Invoice Date is required</span>');
            errors++;
        }

        if (!$('#image').prop('files')[0] && !$('#image').data('is-updating')) {
            $('#image').after('<span class="error">Image is required</span>');
            errors++;
        } else if ($('#image').prop('files')[0]) {
            var file = $('#image').prop('files')[0];
            var allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
            if (allowedMimes.indexOf(file.type) === -1) {
                $('#image').after('<span class="error">Invalid file type. Allowed types: jpeg, png, jpg, pdf</span>');
                errors++;
            }
            if (file.size > 3072 * 1024) {
                $('#image').after('<span class="error">File size exceeds the limit (3MB)</span>');
                errors++;
            }
        }

        if ($('#customer_email').val() === '') {
            $('#customer_email').after('<span class="error">Customer Email is required</span>');
            errors++;
        } else if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test($('#customer_email').val())) {
            $('#customer_email').after('<span class="error">Invalid email format</span>');
            errors++;
        }

        if (errors > 0) {
            return;
        }

        this.submit();
    });
});

// cancel button
document.getElementById('cancel-button').addEventListener('click', function() {
    window.location.href = '{{ route('dashboard') }}';
});
</script>
</x-app-layout>
