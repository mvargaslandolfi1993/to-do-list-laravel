<?php

namespace App\Dtos\Comment;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AddTaskCommentDto
{
    public $content;
    public $user_id;

    /**
     * Create a new DTO instance.
     *
     * @param string $title
     * @throws ValidationException
     */
    private function __construct(string $content, string $user_id)
    {
        $this->content = $content;
        $this->user_id = $user_id;
    }

    public static function create(array $data)
    {
        $payload = self::validate($data);

        return new AddTaskCommentDto(
            $payload->content,
            $payload->user_id
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
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data = $validator->validated();

        return (object) $data;
    }
}
