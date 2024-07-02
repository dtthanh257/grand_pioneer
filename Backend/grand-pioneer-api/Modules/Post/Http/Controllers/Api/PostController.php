<?php

namespace Modules\Post\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Post\Transformers\PostTransformer;
use Modules\Post\Http\Requests\PostStoreRequest;
use Modules\Post\Http\Requests\PostUpdateRequest;
use Modules\Post\Repositories\PostRepository;

class PostController extends BaseApiController
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository) {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request) {
        $query = $this->postRepository;

        $posts = $query->get();

        return $this->respondSuccess($this->transform($posts, new PostTransformer(), 'posts'));
    }

    public function show($post_id) {
        $post = $this->postRepository->find($post_id);

        if(!$post) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($post, new PostTransformer(), 'post'));
    }

    public function store(PostStoreRequest $request)
    {
        $post = $this->postRepository->create($request->all());
        $post->refresh();

        return $this->respondSuccess($this->transform($post, new PostTransformer(), 'post'));
    }

    public function update($post_id, PostUpdateRequest $request)
    {
        $post = $this->postRepository->find($post_id);

        if(!$post) {
            return $this->respondNotFound();
        }

        $post->update($request->all());

        return $this->respondSuccess($this->transform($post, new PostTransformer(), 'post'));
    }

    public function destroy($post_id)
    {
        $post = $this->postRepository->find($post_id);

        if (!$post) {
            return $this->respondNotFound();
        }

        $post->delete();

        return $this->respondSuccess();
    }
}