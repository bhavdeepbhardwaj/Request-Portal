<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Comment extends Model
{
    protected $fillable = [
        'body', 'user_name', 'job_no'
    ];
    
    public function post()
    {
        return $this->belongsTo('App\Ticket');
    }
  
    public function user()
    {
        return $this->belongsTo('App\Admin');
        return $this->belongsTo('App\Client');

    }
}