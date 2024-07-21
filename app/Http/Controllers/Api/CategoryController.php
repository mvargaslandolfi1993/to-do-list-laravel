<?php

namespace App\Http\Controllers\Api;

use App\Actions\Category\CreateCategory;
use App\Dtos\Category\CreateCategoryDto;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return CategoryResource
     */
    public function index(Request $request)
    {
        return CategoryResource::collection(
            Category::paginate($request->get('limit', 25))
        );
    }
    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $dto = CreateCategoryDto::create($request->all());

        $category = CreateCategory::handle($dto);
        
        return new CategoryResource($category);
    }
}
