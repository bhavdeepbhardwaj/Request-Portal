<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edit extends Model
{
    //
    protected $fillable = [
        'jobno','comments', 'reference'
    ];
}
