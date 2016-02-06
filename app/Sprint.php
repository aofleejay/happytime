<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $table    = 'sprint';
    protected $fillable = ['sprint', 'start', 'end'];
}
