<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    
     /**
     * The table associated with the model.
     *
     * @var string
     */

     protected $table = 'products';


     /**
      * The attributes that are mass assignable.
      *
      * @var array<int, string>
      */
     protected $fillable = [
         'name',
         'description',
         'short_description',
         'slug',
         'price',
         'sale_price',
         'avatar_id'
     ];

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

    public function tags()  {
        return $this->morphToMany(Tag::class, 'taggables', 'taggables', 'taggable_id', 'tag_id');
    }

}
