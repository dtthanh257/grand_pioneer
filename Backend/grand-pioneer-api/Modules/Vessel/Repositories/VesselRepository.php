<?php

namespace Modules\Vessel\Repositories;

use Modules\Vessel\Entities\Vessel;
use Prettus\Repository\Eloquent\BaseRepository;

class VesselRepository extends BaseRepository
{
    public function model() {
        return Vessel::class;
    }

    public function find($id, $column = ['*']) {
        return parent::find($id, $column);
    }
}