<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'nick_name', 'birth_date', 'email', 'password', 'role', '',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function posts(){
        
        return $this->hasMany(Post::class);
        
    }
    
    public function comments(){
        
        return $this->hasMany(Comment::class);
        
    }
    
    /**
     * Set the user's name.
     * 
     * @param type $name string
     * @return void
     */
    public function setNameAttribute($name){
        $this->attributes['name'] = ucfirst(strtolower($name));
    }
    
    /**
     * Set the user's surname.
     * 
     * @param type $surname string
     * @return void
     */
    public function setSurnameAttribute($surname){
        $this->attributes['surname'] = ucfirst(strtolower($surname));
    }
}
