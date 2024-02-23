<?php

namespace App\Models;

use App\Models\User;
use App\Models\Programme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_name',
        'uni_email',
        'uni_phone_number',
        'logo',
        'website_url',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }
}
