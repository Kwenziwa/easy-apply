<?php

namespace App\Models;

use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'code',
        'closing_date',
        'min_points',
        'min_entry_requirements',
        'entry_term',
        'course_duration',
        'access_route',
        'notes'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
