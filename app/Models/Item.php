<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'item_name', 'item_image', 'item_type', 'item_category_id', 'item_location',
        'item_supplier_id', 'item_quantity', 'item_reorder_level', 'item_buying_price',
        'item_selling_price', 'item_catering_levy', 'item_excise_duty', 'item_vat', 'item_package_type', 'item_batch_no',
        'item_expiry_date', 'item_description'
    ];
}
