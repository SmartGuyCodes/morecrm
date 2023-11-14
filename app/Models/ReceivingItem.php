<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'client_id', 'grn_no', 'item_id', 'item_name',
        'item_discount', 'item_qty', 'item_price'
    ];
}
