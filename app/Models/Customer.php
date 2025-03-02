<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'email',
        'address',
        'phone',
        'city',
        'note'
    ];

    public function order(){
        return $this->hasOne(Order::class);
    }
}
