<?php

namespace App\Models;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'name',
        'code',
        'closing_date',
        'min_points',
        'min_entry_requirements',
        'entry_term',
        'course_duration',
        'application_url',
        'access_route',
        'notes'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

    // Programme model
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'programme_subject')->withPivot(['programme_id', 'subject_id', 'level']);
        ;
    }
}
