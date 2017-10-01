<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    protected $fillable = ['from','to','text','poll_id'];
}
