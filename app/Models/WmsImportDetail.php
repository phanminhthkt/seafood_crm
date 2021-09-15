<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WmsImportDetail extends Model
{
    use HasFactory;
    protected $table = 'wms_import_details';
    protected $fillable = [
        'import_id',
        'product_id',
        'product_code',
        'product_name',
        'product_price',
        'status_id',
        'product_quantity',
        'product_unit',
    ];
}
