<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full mt-6">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Invoice Date</th>
                                <th>Customer Name</th> 
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th>Tax Amount</th>
                                <th>Net Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $key => $invoice)
                                @php
                                    $key++;
                                @endphp
                                <tr align="center">
                                    <td>{{ $key }}</td>
                                    <td>{{ date('d-m-Y', strtotime($invoice->invoice_date)) }}</td>
                                    <td>{{ $invoice->customer_name }}</td>
                                    <td>{{ $invoice->quantity }}</td>
                                    <td>{{ $invoice->total_amount }}</td>
                                    <td>{{ $invoice->tax_amount }}</td>
                                    <td>{{ $invoice->net_amount }}</td>
                                    <td>
                                        <a href="{{"edit-invoice/" .$invoice['id']}}"><i class="fa-regular fa-pen-to-square"></i></a>&nbsp;&nbsp;
                                        <a href="{{"delete-invoice/" .$invoice['id']}}" onclick="return confirm('Are you sure you want to delete this invoice?')"><i class="fa-regular fa-trash-can" style="color: #ed0707;"></i></a>
                                    </td>
                                </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
