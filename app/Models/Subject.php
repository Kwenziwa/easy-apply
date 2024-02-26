<?php

namespace App\Models;

use App\Models\User;
use App\Models\Programme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name','code'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('result', 'level')->withTimestamps();
    }

    public function programmes()
    {
        return $this->belongsToMany(Programme::class, 'programme_subject');
    }
}
