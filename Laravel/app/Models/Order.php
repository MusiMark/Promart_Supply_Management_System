<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model{
    
    protected $table = 'order';
    protected $primaryKey = 'id';
    public $incrementing = false;              
    protected $keyType = 'string'; 
    
    protected $fillable = [
        'id',
        'user_id', 
        'status', 
        'amount', 
        'delivery_date', 
        'payment_method', 
        'shipping_address'
    ];

    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }
}
