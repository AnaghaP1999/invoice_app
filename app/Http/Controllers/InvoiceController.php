<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    private $invoice;

    // constructor
    public function __construct(Invoice $invoice) {
        $this->invoice = $invoice;
    }

    // To get all the invoices
    public function index() {
        $invoices = $this->invoice->getInvoices();

        return view('dashboard', ['invoices' => $invoices]);
    }

    // invoice form
    public function invoiceForm() {
        return view('invoice-form');
    }

    // To generate/update invoice
    public function generateInvoice(Request $request) {

        $rules = [
            'quantity' => 'required|numeric',
            'amount' => 'required|numeric',
            'tax_perc' => 'required',
            'customer_name' => 'required|regex:/^[A-Za-z\s]+$/',
            'invoice_date' => 'required',
            'customer_email' => 'required|email'
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'required|file|mimes:jpeg,png,jpg,pdf|max:3072';
        } else {
            $rules['image'] = 'file|mimes:jpeg,png,jpg,pdf|max:3072';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Return validation errors to the view
            return back()->withErrors($validator)->withInput();
        }

        $id = $request->id ?? '';
        $data = $request->all();
        $data['total_amount'] = $data['quantity'] * $data['amount'];
        $data['tax_amount'] = ($data['total_amount'] * $data['tax_perc']) / 100;
        $data['net_amount'] = $data['total_amount'] + $data['tax_amount'];
        
        if($id != '') {
            $invoiceDetails = $this->invoice->getInvoiceById($id);
            if ($request->hasFile('image')) {
                $file = $invoiceDetails->image;

                if (Storage::exists($file)) {
                    Storage::delete($file);
                }

                $imagePath = $request->file('image')->store('files');
                $data['image'] = $imagePath;
            }

            $invoiceDetails->update($data);
            $template = 'update-email-template';
           
        } else {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('files');
                $data['image'] = $imagePath;
            }
            $this->invoice->create($data);
           
            $template = 'email-template';
        }

        $this->sendInvoiceEmail($data, $template);

        return redirect()->route('dashboard')->with('success', 'Invoice generated/updated successfully.');
    }

    // send email after invoice generated
    private function sendInvoiceEmail($data, $template) {
        $mail_data = [
            'recipient' => $data['customer_email'],
            'fromEmail' => 'vibhamohan96@gmail.com',
            'fromName' => 'Your Invoice',
            'subject' => 'Invoice Details',
            'body' => $data,
        ];
    
        if (isset($data['image'])) {
            \Mail::send($template, $mail_data, function($message) use ($mail_data, $data) {
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject']);
                
                $filePath = storage_path('app/' . $data['image']);
                $fileName = basename($filePath);
    
                $message->attach($filePath, [
                    'as' => $fileName,
                ]);
            });
        } else {
            \Mail::send($template, $mail_data, function($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject']);
            });
        }
    }

    // get invoice details by id
    public function editInvoiceDetails(int $id = null) {
        $invoiceDetails = $this->invoice->getInvoiceById($id);

        return view('edit-invoice', [
            'invoiceDetails' => $invoiceDetails,
            'id' => $id
        ]);
    }

    // to get uploaded file
    public function serveFile($filename) {
        $file = storage_path('app/' . $filename);

        if (file_exists($file)) {
            return response()->file($file);
        }

        return response()->json(['message' => 'File not found'], 404);
    }

    // to delete invoice
    public function deleteInvoice(int $id = null) {
        $invoiceDetails = $this->invoice->getInvoiceById($id);
        if ($invoiceDetails) {
            $file = $invoiceDetails->image;

            if (Storage::exists($file)) {
                // Delete the file from the storage
                Storage::delete($file);
            }
            $invoiceDetails->delete();
            return redirect()->route('dashboard')->with('success', 'Invoice deleted successfully');
        }
        return redirect()->route('dashboard')->with('error', 'Invoice not found');
    }
}
