<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Vessel\Entities\Vessel;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'name', 'title', 'description', 'sub_title', 'sub_description', 'language'
    ];

    protected $dates = ['created_at', 'updated_at'];
}
