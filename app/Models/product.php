<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'brand_id',
        'category_id',
        'image',
        'discount',
        'discount',
        'amount',
        'price',
        'is_avalible',
        'is_trendy',
        'name'
    ];
    public function brand(){
        return $this->belongsTo(brand::class, 'brand_id');

    }
    public function category(){
        return $this->belongsTo(category::class, 'category_id');

    }
}
