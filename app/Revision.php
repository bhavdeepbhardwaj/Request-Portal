<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    //
    protected $fillable = [
        'jobno','comments', 'reference'
    ];
}
