<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['body', 'user_id', 'attachment'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
