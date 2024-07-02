<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Vessel\Entities\Vessel;

class Service extends Model
{
    protected $fillable = [
        'vessel_id', 'title', 'content', 'opening_hour', 'location', 'language'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function serviceMetadata() {
        return $this->hasMany(ServiceMetadata::class);
    }

    public function vessel() {
        return $this->belongsTo(Vessel::class);
    }
}
