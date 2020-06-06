<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThoughtsCategory extends Model
{
    protected $fillable = [
        'category_name', 'description'
    ];

    public function thoughts(){
        return $this->hasMany('App\Models\Thoughts','thoughtCategory_id');
    }

}
