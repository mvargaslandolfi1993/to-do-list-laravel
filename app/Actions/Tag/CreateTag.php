<?php

namespace App\Actions\Tag;

use App\Dtos\Tag\CreateTagDto;
use App\Models\Tag;

class CreateTag
{
    /**
     * Handle the create tag action
     * @param CreateTagDto $dto
     */
    public static function handle(CreateTagDto $dto): Tag
    {  
        return Tag::create((array) $dto);
    }
}
