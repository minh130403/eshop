<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * The table 
     */

    protected $table = "tags";


    /**
     * the fillabe
     */

    protected $fillable = [
        'name',
        'slug'
    ];


    public function products(){
        return $this->morphedByMany(Product::class, 'taggables', 'taggables', 'tag_id', 'taggable_id',);
    }


}
