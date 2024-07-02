<?php

namespace Modules\Post\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Post\Entities\PostSection;

class PostSectionTransformer extends TransformerAbstract
{
    public function transform(PostSection $post_section)
    {
        return [
            'id' => $post_section->id,
            'post_id' => $post_section->post_id,
            'section_name' => $post_section->section_name,
            'content' => $post_section->content,
            'image_link' => $post_section->image_link,
            'image_name' => $post_section->image_name,
            'language' => $post_section->language,
            'created_at' => $post_section->created_at ? $post_section->created_at->toDateTimeString() : null,
            'updated_at' => $post_section->updated_at ? $post_section->updated_at->toDateTimeString() : null,
        ];
    }
}
