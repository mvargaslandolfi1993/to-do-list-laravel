<?php

namespace App\Models;

use App\Filters\Task\CategoryFilter;
use App\Filters\Task\PriorityFilter;
use App\Filters\Task\StatusFilter;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, HasUuids, Filterable;

    const PENDING_STATUS = 'Pending';

    const IN_PROGRESS_STATUS = 'In Progress';

    const COMPLETED_STATUS = 'Completed';

    protected $fillable = ['title', 'description', 'status', 'due_date', 'priority', 'category_id', 'user_id'];

    /**
     * Get the category that the task belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    /**
     * Get the user that owns the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the comments for the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the subtasks for the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }

    /**
     * Get the tags for the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the reminders for the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    /**
     * Return the filters that should be use by default
     * @return array
     */
    public function filters(): array
    {
        return  [
            'priority' => PriorityFilter::class,
            'status' => StatusFilter::class,
            'category' => CategoryFilter::class,
        ];
    }
}
