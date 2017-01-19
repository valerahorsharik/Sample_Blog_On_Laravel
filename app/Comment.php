<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'post_id',
    ];
    
     public function user() {
        
        return $this->belongsTo(User::class);
        
    }
    
     public function post() {
        
        return $this->belongsTo(Post::class);
        
    }
    
    public function setUpdatedAt($value) {
        return $this;
    }
}
