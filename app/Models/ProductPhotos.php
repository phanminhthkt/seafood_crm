<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhotos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_photos';
    protected $fillable = [
        'product_id',
        'name',
        'photo',
        'is_priority',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
