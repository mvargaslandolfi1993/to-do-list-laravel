<?php

namespace App\Models;

use App\Models\Traits\Uidable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    use HasFactory, Uidable;

    protected $fillable = ['title', 'status'];

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
