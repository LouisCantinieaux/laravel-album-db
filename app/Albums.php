<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    protected $fillable = [
      'title',
      'description'
    ];
}
