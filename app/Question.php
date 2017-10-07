<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['name', 'poll_id'];

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}

