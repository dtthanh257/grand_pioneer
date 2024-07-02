<?php

namespace Modules\Voyage\Repositories;

use Modules\Voyage\Entities\Activity;
use Prettus\Repository\Eloquent\BaseRepository;

class ActivityRepository extends BaseRepository
{
    public function model() {
        return Activity::class;
    }

    public function find($id, $column = ['*']) {
        return parent::find($id, $column);
    }

    public function create(array $attributes)
    {
        return parent::create($attributes); // TODO: Change the autogenerated stub
    }
}