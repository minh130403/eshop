<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubOrder extends Model
{
    use HasFactory;

    protected $table='sub-orders';

    public function order()  {
        return $this->belongsTo(Order::class);
    }

    protected $fillable = [
        'product_name',
        'order_id',
        'quantity',
        'total_price',
        'product_price',
    ];
}
