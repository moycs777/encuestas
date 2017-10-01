<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['name','category_id','hour','minutes','seconds','status'];
}
