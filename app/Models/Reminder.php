<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminder extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    const PENDING_STATUS = 'Pending';

    const COMPLETED_STATUS = 'Completed';
    
    protected $fillable = ['remind_at', 'is_sent', 'task_id'];

    /**
     * Get the task that owns the reminder.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
