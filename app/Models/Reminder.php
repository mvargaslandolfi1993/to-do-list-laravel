<?php

namespace App\Models;

use App\Models\Traits\Uidable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory, Uidable;

    protected $fillable = ['title', 'description', 'status', 'due_date'];

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
