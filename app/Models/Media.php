<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use  HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'images';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'alt',
        'src',
    ];

    public function categories(){
        return $this->hasMany(Category::class, 'avatar_id');
    }

    public function products()  {
        return $this->hasMany(Product::class, 'avatar_id');
        
    }

}
