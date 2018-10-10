<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category'
    ];
    /**
     * Get the books for the category.
     */
    public function hasBooks()
    {
        return $this->hasMany('App\Book');
    }
}
