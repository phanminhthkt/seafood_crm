<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'photo',
        'name',
        'sku',
        'type',
        'import_price',
        'export_price',
        'parent_id',
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
    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }
    public function photos()
    {
        return $this->hasMany(ProductPhotos::class,'product_id');
    }
    public function children()
    {
        return $this->hasMany(Product::class, 'parent_id');
    }
    public function group_attributes()
    {
        return $this->belongsToMany(GroupAttribute::class,'product_attribute','product_id','group_attribute_id');
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class,'product_attribute','product_id','attribute_id');
    }
}
