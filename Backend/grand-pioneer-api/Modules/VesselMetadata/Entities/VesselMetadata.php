<?php

namespace Modules\VesselMetadata\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Vessel\Entities\Vessel;

class VesselMetadata extends Model
{
    protected $fillable = [
        'vessel_id', 'image_link'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function vessel() {
        return $this->belongsTo(Vessel::class);
    }
}
