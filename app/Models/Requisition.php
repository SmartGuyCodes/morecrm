<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id','requisition_lpo_number','requisition_title', 'requisition_item_name', 'requisition_item_stock_level',
        'requisition_urgency', 'requisition_date', 'requisition_department', 'requisition_quantity', 'requisition_notes',// '', '',
    ];
}
