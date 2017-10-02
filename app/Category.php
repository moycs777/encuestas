<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'pausable'];

    public function polls()
    {
        return $this->hasMany('App\Poll');
    }
}
