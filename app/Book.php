<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $attributes = [
        'edition' => 'No Edition'
    ];
    public $timestamps = false;
    protected $fillable = [
        'category_id','name','publisher', 'author', 'available'
    ];

    /**
     * Get the category that owns the book.
     */
    public function category()
    {   
        //this book belongs to the category
        return $this->belongsTo('App\Category');
    }
}
