<?php

namespace App\Http\Controllers\Api\V1\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
class PostController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(): AnonymousResourceCollection
    {
        $posts = Post::useFilters()->dynamicPaginate();
        return PostResource::collection($posts);
    }

    public function store(CreatePostRequest $request): JsonResponse
    {
        $post = Post::create($request->validated());
        return $this->apiResponseStored(new PostResource($post));
    }

    public function show(Post $post): JsonResponse
    {
        return $this->apiResponseShow(new PostResource($post));
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        Gate::authorize('update', $post);
        $post->update($request->validated());
        return $this->apiResponseUpdated(new PostResource($post));
    }

    public function destroy(Post $post): JsonResponse
    {
        Gate::authorize('delete', $post);
        $post->delete();
        return $this->apiResponseDeleted();
    }

   
}
