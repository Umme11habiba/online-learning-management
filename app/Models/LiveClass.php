<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveClass extends Model
{
    protected $fillable = ['course_id','title','date','link'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}