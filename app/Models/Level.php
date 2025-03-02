<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    /**
     * The table associated with the model
     * 
     * @var string
     */

    protected $table = 'user_levels';


    /**
      * The attributes that are mass assignable.
      *
      * @var array<int, string>
      */
      protected $fillable = [
        'name',
    ];

    /**
     * Get the product that owns the comment.
     */

    public function users(){
        return $this->hasMany(User::class);
    }

}
