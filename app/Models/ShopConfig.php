<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShopConfig extends Model
{
    use HasFactory;

    protected $table = 'shop-config';


    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'favicon',
        'logo',
        'currency'
    ];



}
