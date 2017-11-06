<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['name','category_id', 'show_all_questions', 'status'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function ranges()
    {
        return $this->hasMany('App\Range');
    }
}
