<?php

namespace Modules\Post\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use Modules\Post\Transformers\PostSectionTransformer;
use Modules\Post\Http\Requests\PostSectionStoreRequest;
use Modules\Post\Http\Requests\PostSectionUpdateRequest;
use Modules\Post\Entities\Post;

class PostSectionController extends BaseApiController
{
    public function index($post_id, Request $request)
    {
        $post = Post::query()->find($post_id);

        if(!$post) {
            return $this->respondNotFound();
        }

        $post_section = $post->postSection;

        if (!$post_section) {
            return $this->respondNotFound();
        }
        
        return $this->respondSuccess($this->transform($post_section, new PostSectionTransformer(), 'post_sections'));
    }

    public function store($post_id, PostSectionStoreRequest $request)
    {
        $post = Post::query()->find($post_id);

        if (!$post) {
            return $this->respondNotFound();
        }

        $post_section = $post->postSection()->create($request->all());

        return $this->respondSuccess($this->transform($post_section, new PostSectionTransformer(), 'post_section'));
    }

    public function update($post_id, $post_section_id, PostSectionUpdateRequest $request)
    {
        $post = Post::query()->find($post_id);

        if (!$post) {
            return $this->respondNotFound();
        }

        $post_section = $post->postSection()->find($post_section_id);

        if(!$post_section) {
            return $this->respondNotFound();
        }

        $post_section->update($request->all());

        return $this->respondSuccess($this->transform($post_section, new PostSectionTransformer(), 'post_section'));
    }

    public function destroy($post_id, $post_section_id)
    {
        $post = Post::query()->find($post_id);

        if (!$post) {
            return $this->respondNotFound();
        }

        $post_section = $post->postSection->find($post_section_id);

        if (!$post_section) {
            return $this->respondNotFound();
        }

        $post_section->delete();

        return $this->respondSuccess();
    }
}