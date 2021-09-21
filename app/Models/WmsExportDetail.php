<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WmsExportDetail extends Model
{
    use HasFactory;
    protected $table = 'wms_export_details';
    protected $fillable = [
        'export_id',
        'product_id',
        'product_code',
        'product_name',
        'product_price',
        'product_quantity',
        'product_unit',
    ];
    public function wmsExport(){
        return $this->belongsTo(WmsExport::class,'export_id');
    }
}
