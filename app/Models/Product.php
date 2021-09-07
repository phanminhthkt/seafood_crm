<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'sku',
        'type',
        'import_price',
        'export_price',
        'category_id',
        'unit_id',
        'is_status',
        'is_priority',
        'received_at',
        'begin_at',
    ];
    public function category(){
    	return $this->belongsTo(Category::class);
    }
    public function unit(){
    	return $this->belongsTo(Unit::class);
    }
}
