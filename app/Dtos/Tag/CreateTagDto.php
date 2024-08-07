<?php

namespace App\Dtos\Tag;

use App\Models\Tag;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class CreateTagDto
{
    public string $name;
    public string $slug;

    /**
     * Create a new DTO instance.
     *
     * @param string $title
     * @throws ValidationException
     */
    private function __construct(string $name, string $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public static function create(array $data)
    {
        $payload = self::validate($data);

        return new CreateTagDto(
            $payload->name,
            $payload->slug,
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
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data = $validator->validated();

        $slug = Str::of($data['name'])->slug('-');

        $slug_exists = Tag::where('slug', $slug)->exists();

        if($slug_exists) {
            throw new Exception('Slug already exists');
        }
        
        Arr::set($data, 'slug', $slug);

        return (object) $data;
    }
}
