<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'status',
        'budget',
        'total_spent',
        'started_at',
        'finished_at',
    ];

    public function tasks()
    {
        return $this->hasMany(ProjectTask::class);
    }
}
