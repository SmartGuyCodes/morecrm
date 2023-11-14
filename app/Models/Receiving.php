<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'uuid', 'receiving_grn', 'receiving_supplier_id', 'receiving_voucher_no',
        'received_by', 'receiving_department', 'receiving_mode', 'receiving_notes',
        'receiving_date_time', 'receiving_products_qty', 'total_paid_amount', 'balance_due',
        'txn_ref', 'payment_method'//, '',
    ];
}
