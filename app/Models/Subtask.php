<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subtask extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    const PENDING_STATUS = 'Pending';

    const IN_PROGRESS_STATUS = 'In Progress';

    const COMPLETED_STATUS = 'Completed';
    
    protected $fillable = ['title', 'status', 'task_id'];

    /**
     * Get the task that owns the subtask.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
