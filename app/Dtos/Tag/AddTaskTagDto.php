<?php

namespace App\Dtos\Tag;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AddTaskTagDto
{
    /**
     * The tags to be added to the task
     * @var array
     */
    public array $tags;

    /**
     * Create a new DTO instance.
     * @param array $tags
     * @throws ValidationException
     */
    private function __construct(array $tags)
    {
        $this->tags = $tags;
    }

    public static function create(array $data, string $task_id)
    {
        $payload = self::validate($data, $task_id);

        return new AddTaskTagDto(
            $payload->tags,
        );
    }

    /**
     * Validate the data
     *
     * @param array $data
     * @throws ValidationException
     */
    protected static function validate(array $data, string $task_id)
    {
        $validator = Validator::make($data, [
            'tags' => 'required|array',
            'tags.*' => [
                'required',
                'string',
                'exists:tags,id',
                Rule::unique('task_tags', 'tag_id')->where('task_id', $task_id),
            ],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data = $validator->validated();

        return (object) $data;
    }
}
