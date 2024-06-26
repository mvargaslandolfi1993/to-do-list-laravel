<?php

namespace App\Dtos\SubTask;

use App\Models\Subtask;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateSubTaskDto
{
    public $title;
    public $status;
    public $task_id;

    /**
     * Create a new DTO instance.
     *
     * @param string $title
     * @param string $status
     * @param string $task_id
     * @throws ValidationException
     */
    private function __construct(    
        string $title,
        string $status,
        string $task_id
    )
    {
        $this->title = $title;
        $this->status = $status;
        $this->task_id = $task_id;
    }

    public static function create(array $data)
    {
        $payload = self::validate($data);

        return new CreateSubTaskDto(
            $payload->title,
            $payload->status,
            $payload->task_id
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
            'title' => ['required', 'string', 'max:255'],
            'task_id' => ['required', 'string', 'exists:tasks,id'],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data = $validator->validated();

        Arr::set($data, 'status', Subtask::PENDING_STATUS);

        return (object) $data;
    }
}
