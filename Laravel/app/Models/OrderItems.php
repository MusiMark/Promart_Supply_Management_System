<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model{
    protected $table = 'order_details';

    protected $fillable = [
        'order_id', 
        'product_id', 
        'quantity', 
        'price', 
        'notes'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
