<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biji extends Model
{
    //
    protected $fillable = ['user_id', 'book_id', 'title', 'content', 'published_at'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
