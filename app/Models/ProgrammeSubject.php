<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\Programme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ProgrammeSubject extends Model
{
    use HasFactory;

    protected $table = 'programme_subject';

    // If your pivot table doesn't use the default 'id' as its primary key, or if you want to disable auto-incrementing, specify it here
    public $incrementing = true;

    // If you're using a different connection for this model, specify it
    // protected $connection = 'connection-name';

    protected $fillable = ['programme_id', 'subject_id', 'level'];

    // Define the relationships if necessary, for example:
    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
