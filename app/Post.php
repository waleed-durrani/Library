<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //mass assignable
    protected $fillable = [
        'title', 'body'
    ];
}
