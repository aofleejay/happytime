<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $table    = 'stat';
    protected $fillable = ['user_id', 'user_name', 'text'];
}
