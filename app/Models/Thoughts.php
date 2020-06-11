<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Jcc\LaravelVote\CanBeVoted;


class Thoughts extends Model
{
    use CanBeVoted;

    protected $vote = User::class;

    protected $fillable = [
        'title', 'thought', 'image', 'thoughtCategory_id', 'user_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\ThoughtsCategory', 'thoughtCategory_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment', 'post_id');
    }
}
