<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // $table->enum('supplier_type', ['local', 'international'])->default('local');
    // $table->enum('supplier_status', ['active', 'inactive'])->default('active');
    // $table->bigInteger('supplier_balance')->default(0);
    // $table->bigInteger('supplier_paid_balance')->default(0);

    protected $fillable = [
        'client_id', 'company_name', 'company_postal_address', 'company_physical_address',
        'company_email', 'company_phone_no', 'company_contact_person',
        'company_contact_person_email', 'company_contact_person_phone',
        'supplier_type', 'supplier_status', 'supplier_balance', 'supplier_paid_balance'
    ];
}
