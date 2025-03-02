<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot(){
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::random(6); // Tạo ID ngẫu nhiên 6 ký tự
            }
        });
    }


    public function subOrders() {
        return $this->hasMany(SubOrder::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
