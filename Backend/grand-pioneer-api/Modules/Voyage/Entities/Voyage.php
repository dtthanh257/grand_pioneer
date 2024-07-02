<?php

namespace Modules\Voyage\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Vessel\Entities\Vessel;

class Voyage extends Model
{
    protected $fillable = [
        'vessel_id' ,'title', 'content', 'summary_location', 'embark', 'debark', 'fares', 'language'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function vessel() {
        return $this->belongsTo(Vessel::class);
    }

    public function voyageMetadata() {
        return $this->hasMany(VoyageMetadata::class);
    }

    public function voyageExperience() {
        return $this->hasMany(VoyageExperience::class);
    }

    public function voyageTimeline() {
        return $this->hasMany(VoyageTimeline::class);
    }

    public function voyageDateAvailable() {
        return $this->hasMany(VoyageDateAvailable::class);
    }

    public function voyageLocation() {
        return $this->hasMany(VoyageLocation::class);
    }

    public function activity() {
        return $this->hasMany(Activity::class);
    }
}
