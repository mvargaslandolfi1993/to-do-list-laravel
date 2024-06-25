<?php

namespace App\Http\Controllers;

use App\Actions\Tag\CreateTag;
use App\Dtos\Tag\CreateTagDto;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return TagResource
     */
    public function index(Request $request)
    {
        return TagResource::collection(
            Tag::paginate($request->get('limit', 25))
        );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $dto = CreateTagDto::create($request->all());

        $tag = CreateTag::handle($dto);

        return new TagResource($tag);
    }
}
