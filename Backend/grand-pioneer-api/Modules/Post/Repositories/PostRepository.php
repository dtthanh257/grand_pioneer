<?php

namespace Modules\Post\Repositories;

use Modules\Post\Entities\Post;
use Prettus\Repository\Eloquent\BaseRepository;

class PostRepository extends BaseRepository
{
    public function model() {
        return Post::class;
    }

    public function find($id, $column = ['*']) {
        return parent::find($id, $column);
    }
}