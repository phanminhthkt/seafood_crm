<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WmsImport extends Model
{
    use HasFactory;
    protected $table = 'wms_imports';
    protected $fillable = [
        'code',
        'total_price',
        'store_id',
        'user_id',
        'status_id',
        'note',
        'note_cancel',
    ];
    public function status(){
        return $this->belongsTo(Status::class,'status_id')->where('group_id','=',1);
    }
    public function store(){
        return $this->belongsTo(Wms::class,'store_id');
    }
    public function details(){
        return $this->hasMany(WmsImportDetail::class,'import_id');
    }
}
