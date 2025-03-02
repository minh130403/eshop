<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->morphToMany(Category::class, 
        'products_categories',
         'products_categories',
        'product_id',
        'category_id',
     );
    }

    public function avatar(){
        return $this->belongsTo(Media::class);
    }

    /**
     * Get the comments for the product
     */

    public function comments(){
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

}
