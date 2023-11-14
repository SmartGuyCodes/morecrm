<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    // $table->string('txn_ref');
    // $table->enum('txn_type', ['income', 'expense'])->default('income');
    // $table->bigInteger('total_amount_paid');
    // $table->string('payment_method');
    // $table->string('payment_type');
    // $table->string('invoice_no');
    // $table->string('receipt_no');

    protected $fillable = [
        'txn_ref', 'txn_type', 'total_amount_paid', 'payment_method',
        'payment_type','payment_status', 'invoice_no', 'receipt_no'
    ];
}
