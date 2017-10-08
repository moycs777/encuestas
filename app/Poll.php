<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['name','category_id', 'status'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
