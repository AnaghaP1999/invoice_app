<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $fillable = [
        'id',
        'quantity',
        'amount',
        'total_amount',
        'tax_perc',
        'tax_amount',
        'net_amount',
        'customer_name',
        'invoice_date',
        'customer_email',
        'image'
    ];

    // Get all invoices
    public function getInvoices() {
        $invoices = $this->orderBy('id', 'DESC')->get();
        
        return $invoices;
    }

    // Get invoice deatails by id
    public function getInvoiceById(int $id = null) {
        $invoices = $this->where('id', $id)->first();
        
        return $invoices;
    }
}
