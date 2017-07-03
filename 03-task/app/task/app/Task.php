<?php

namespace Task;

use Illuminate\Database\Eloquent\Model;

use Task\User;

class Task extends Model
{
    //
    protected $fillable = ['name'];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
