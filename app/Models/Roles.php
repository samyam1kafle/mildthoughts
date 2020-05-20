<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $fillable = [
      'role','access'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }
}
