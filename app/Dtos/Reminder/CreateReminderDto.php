<?php

namespace App\Dtos\Reminder;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateReminderDto
{
    public $task_id;
    public $remind_at;
    /**
     * Create a new DTO instance.
     * @param string $task_id
     * @param string $remind_at
     * @throws ValidationException
     */
    private function __construct(    
        string $task_id,
        string $remind_at
    )
    {
        $this->task_id = $task_id;
        $this->remind_at = $remind_at;
    }

    public static function create(array $data)
    {
        $payload = self::validate($data);

        return new CreateReminderDto(
            $payload->task_id,
            $payload->remind_at
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
            'task_id' => ['required', 'string', 'exists:tasks,id'],
            'remind_at' => ['required', 'date'],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data = $validator->validated();

        return (object) $data;
    }
}
