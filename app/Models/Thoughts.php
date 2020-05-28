<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thoughts extends Model
{
    protected $fillable = [
        'title','thought','image','thoughtCategory_id','user_id'
    ];

    public function category(){
        return $this->belongsTo('App\Models\ThoughtsCategory','thoughtCategory_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
