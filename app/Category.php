<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'hour','minutes','seconds','pausable','status'];

    public function polls()
    {
        return $this->hasMany('App\Poll');
    }
}
