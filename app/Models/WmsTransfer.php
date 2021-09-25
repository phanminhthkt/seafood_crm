<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WmsTransfer extends Model
{
    use HasFactory;
    protected $table = 'wms_transfers';
    protected $fillable = [
        'code',
        'total_price',
        'store_id',
        'user_id',
        'status_id',
        'note',
        'note_cancel',
        'transfer_created_at',
    ];
    public function status(){
        return $this->belongsTo(Status::class,'status_id')->where('group_id','=',1);
    }
    public function fromStore(){
        return $this->belongsTo(Wms::class,'store_from_id');
    }
    public function toStore(){
        return $this->belongsTo(Wms::class,'store_id');
    }
    public function details(){
        return $this->hasMany(WmsTransferDetail::class,'transfer_id','id');
    }
}
