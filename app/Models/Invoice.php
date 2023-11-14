<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_customer_id', 'invoice_number', 'invoice_txn_reference',
        'invoice_date', 'invoice_payment_due_date', 'invoice_payment_date',
        'invoice_amount', 'invoice_status'
    ];
}
