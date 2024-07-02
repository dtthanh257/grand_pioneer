<?php

namespace Modules\Vessel\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\VesselMetadata\Entities\VesselMetadata;
use Modules\Suite\Entities\Suite;
use Modules\Voyage\Entities\Voyage;
use Modules\Service\Entities\Service;
use Modules\Post\Entities\Post;

class Vessel extends Model
{
    protected $fillable = [
        'name', 'status', 'inclusion', 'exclusion', 'language'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function vesselMetadata() {
        return $this->hasMany(VesselMetadata::class);
    }

    public function suite() {
        return $this->hasMany(Suite::class);
    }

    public function voyage() {
        return $this->hasMany(Voyage::class);
    }

    public function service() {
        return $this->hasMany(Service::class);
    }
}
