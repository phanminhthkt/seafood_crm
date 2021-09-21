<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'phone',
        'address',
        'is_status',
        'is_priority',
    ];
    public function orders()
    {
        return $this->hasMany(WmsExport::class,'customer_id');
    }
    
    public function getTotalPerCustomer(){
    	$total = 0;
    	foreach($this->orders as $val){
    		$total+= ($val->total_price + $val->ship_price - $val->reduce_price);
        }
    	return $total;
    }

}