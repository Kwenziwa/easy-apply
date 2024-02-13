<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectUser extends Model
{
    use HasFactory;

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->using(SubjectUser::class)->withTimestamps();
    }
}
