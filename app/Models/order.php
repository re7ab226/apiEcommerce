<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    // protected $table = 'order_products';
    protected $fillable=[
        'user_id',
        'location_id',
        'status',
        'total_price',
        'date_of_delivery'
    ];



    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function location(){
        return $this->belongsTo(location::class, 'location_id');
    }

    public function item()
    {
        return $this->hasMany(order_products::class, 'order_id', 'id');
    }
    // here i make this relation to get all items on the order

}
