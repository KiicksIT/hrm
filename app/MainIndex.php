<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainIndex extends Model
{
    protected $table = 'mainindexes';

    protected $fillable = [
        'title', 'content'
    ];

}
