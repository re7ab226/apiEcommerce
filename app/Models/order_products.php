<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_products extends Model
{
    use HasFactory;
    protected $fillable=[
                'order_id',
                'quantity',
                'price',
                'product_id'
    ];


    public function order(){
        return $this->belongsTo(order::class,'order_id');
    }
    public function product(){
        return $this->belongsTo(product::class,'product_id');
    }
}
