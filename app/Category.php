<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','user_id'];
    

    // Category.php file

    public function tickets()   
    
    {
        return $this->hasMany(Ticket::class);
    }

    public function user()
    {
        return $this->hasMany('App\Client');

     }

}
