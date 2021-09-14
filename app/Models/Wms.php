<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wms extends Model
{
    use HasFactory;
    protected $table = 'wms_stores';
    protected $fillable = [
        'name',
        'phone',
        'address',
        'is_status',
        'is_priority',
    ];
}
