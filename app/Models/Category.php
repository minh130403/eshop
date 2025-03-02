<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

 /**
     * The table associated with the model.
     *
     * @var string
     */

     protected $table = 'categories';


     /**
      * The attributes that are mass assignable.
      *
      * @var array<int, string>
      */
     protected $fillable = [
         'name',
         'description',
         'avatar_id',
         'slug'
     ];
 
    public function avatar(){
        return $this->belongsTo(Media::class);
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 
        'products_categories', 'products_categories',
         'category_id',
        'product_id',
    'id',
'id');
    }

}
