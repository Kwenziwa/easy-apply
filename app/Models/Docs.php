<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Docs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'doc_type',
        'path'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
