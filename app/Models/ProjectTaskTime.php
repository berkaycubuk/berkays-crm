<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTaskTime extends Model
{
    use HasFactory;

    public $fillable = [
        'project_task_id',
        'started_at',
        'finished_at',
        'is_billable',
    ];

    protected function casts()
    {
        return [
            'is_billable' => 'boolean',
        ];
    }

    public function project_task()
    {
        return $this->belongsTo(ProjectTask::class);
    }
}
