<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{

    protected $fillable = [
        'job','no','user_id','job_no', 'brand', 'country', 'title', 'category_name', 'priority', 'summary', 'objective', 'reference', 'otherinfo', 'comments'
    ];

    // Ticket.php file

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function status()
    {
        return $this->hasMany(Status::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Admin');
        return $this->belongsTo('App\Client');

     }

     public function comments()
     {
         return $this->hasMany('App\Comment');
     }


}
