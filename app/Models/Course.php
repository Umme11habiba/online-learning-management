<?php

namespace App\Models;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
   protected $fillable = ['title', 'description', 'user_id', 'status'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function assignments()
{
    return $this->hasMany(Assignment::class);
}

public function liveClasses()
{
    return $this->hasMany(LiveClass::class);
}

public function recordedClasses()
{
    return $this->hasMany(RecordedClass::class);
}
public function students()
{
    return $this->belongsToMany(User::class, 'enrollments');
}
}
