<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;

    public $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'user_id',
        'deadline_at',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        if ($this->user_id == null) return null;

        return $this->belongsTo(User::class);
    }
}
