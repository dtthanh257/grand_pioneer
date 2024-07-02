<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Vessel\Entities\Vessel;

class Post extends Model
{
    protected $fillable = [
        'title', 'description', 'thumbnail', 'language'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function postSection() {
        return $this->hasMany(PostSection::class);
    }
}
