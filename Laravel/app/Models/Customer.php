<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model{

    protected $table = 'customers';
    protected $primaryKey = 'id';
    public $incrementing = false;              
    protected $keyType = 'string'; 

    protected $fillable = [
        'id',
        'phone',
        'city',
        'address',
        'age_group',
        'gender',
        'income_bracket',
        'purchase_frequency',
        'shopping_preferences'
    ];

    protected $casts = [
        'shopping_preferences' => 'array',
    ];

    public $timestamps = false;


    public function user() {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
