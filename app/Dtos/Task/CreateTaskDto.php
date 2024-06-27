<?php

namespace App\Dtos\Task;

use App\Models\Task;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateTaskDto
{
    public $title;
    public $description;
    public $due_date;
    public $status;
    public $priority;
    public $category_id;
    public $user_id;

    /**
     * Create a new DTO instance.
     *
     * @param string $title
     * @param string $description
     * @param int $due_date
     * @param string $status
     * @param bool $priority
     * @param string $category_id
     * @param string $user_id
     * @throws ValidationException
     */
    private function __construct(string $title, string $description, string $due_date, string $status, string $category_id, string $user_id, bool $priority)
    {
        $this->title = $title;
        $this->description = $description;
        $this->due_date = $due_date;
        $this->status = $status;
        $this->category_id = $category_id;
        $this->user_id = $user_id;
        $this->priority = $priority;
    }

    public static function create(array $data)
    {
        $payload = self::validate($data);

        return new CreateTaskDto(
            $payload->title,
            $payload->description,
            $payload->due_date,
            $payload->status,
            $payload->category_id,
            $payload->user_id,
            $payload->priority ?? false,
        );
    }

    /**
     * Validate the data
     *
     * @param array $data
     * @throws ValidationException
     */
    protected static function validate(array $data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'category_id' => 'required|string|exists:categories,id',
            'user_id' => 'required|int|exists:users,id',
            'priority' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data = $validator->validated();

        Arr::set($data, 'status', Task::PENDING_STATUS);

        return (object) $data;
    }
}
