<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WmsTransferDetail extends Model
{
    use HasFactory;
    protected $table = 'wms_transfer_details';
    protected $fillable = [
        'transfer_id',
        'product_id',
        'product_code',
        'product_name',
        'product_price',
        'product_quantity',
        'product_unit',
    ];
}
