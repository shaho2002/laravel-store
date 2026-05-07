<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'user_address_id',
        'order_code',
        'transaction_id',
        'total_cost',
        'status',
        'send_type'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function user_address()
    {
        return $this->belongsTo(UserAddress::class);
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
