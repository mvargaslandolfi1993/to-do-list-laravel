<?php

namespace App\Actions\Category;

use App\Dtos\Category\CreateCategoryDto;
use App\Models\Category;

class CreateCategory
{
    /**
     * Create a new category.
     * @param CreateCategoryDto $dto
     */
    public static function handle(CreateCategoryDto $dto): Category
    {  
        return Category::create((array) $dto);
    }
}
