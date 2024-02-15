<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NextOfKin extends Model
{
    use HasFactory;

    protected $table = 'next_of_kins';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'relationship',
        'address', // Note the typo here, consider correcting it to 'address' in your migration and model if it was unintentional
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
