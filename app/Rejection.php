<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Rejection extends Model
{
    //
    protected $fillable = ['jobno','reason','comments'];

    public function tickets()   
    {
        return $this->hasMany(Ticket::class);
    }

}


