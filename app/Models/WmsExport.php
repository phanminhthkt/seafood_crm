<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WmsExport extends Model
{
    use HasFactory;
    protected $table = 'wms_exports';
    protected $fillable = [
        'code',
        'total_price',
        'reduce_price',
        'ship_price',
        'store_id',
        'user_id',
        'status_id',
        'customer_id',
        'note',
        'note_cancel',
        'export_created_at',
    ];
    public function status(){
        return $this->belongsTo(Status::class,'status_id')->where('group_id','=',1);
    }
    public function store(){
        return $this->belongsTo(Wms::class,'store_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function details(){
        return $this->hasMany(WmsExportDetail::class,'export_id','id');
    }
    public function getTotalPerOrder(){
        return $this->total_price + $this->ship_price - $this->reduce_price;
    }
}
