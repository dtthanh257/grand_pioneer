<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostSection extends Model
{
    protected $fillable = [
        'post_id', 'section_name', 'content', 'image_link', 'image_name', 'language'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
