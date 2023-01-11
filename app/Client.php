<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Client extends Authenticatable
    {
        use Notifiable;

        protected $guard = 'client';

        protected $fillable = [
            'name', 'email', 'password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];

        
        public function comments()
        {
            return $this->hasMany(Comment::class);
        }
     
        public function tickets()
        {
            return $this->hasMany(Ticket::class);
        }

        public function category()
        {
            return $this->hasMany('App\Category');
        }
    }