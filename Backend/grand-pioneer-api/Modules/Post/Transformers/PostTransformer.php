<?php

namespace Modules\Post\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Post\Entities\Post;

class PostTransformer extends TransformerAbstract
{
    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'description' => $post->description,
            'thumbnail' => $post->thumbnail,
            'post_sections' => $post->postSection ? $post->postSection->map(function ($item) {
                return [
                    'section_name' => $item->section_name,
                    'content' => $item->content,
                    'image_link' => $item->image_link,
                    'image_name' => $item->image_name,
                    'language' => $item->language
                ];
            }) : null,
            'language' => $post->language,
            'created_at' => $post->created_at ? $post->created_at->toDateTimeString() : null,
            'updated_at' => $post->updated_at ? $post->updated_at->toDateTimeString() : null,
        ];
    }
}
