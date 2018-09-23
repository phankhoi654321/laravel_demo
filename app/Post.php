<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    //protected $table = 'Post_Table';

    protected $dates = ['delete_at'];

    protected $fillable = [
        'title',
        'content'
    ];

}
