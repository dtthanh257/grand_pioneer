<?php

namespace Modules\Voyage\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class VoyageLocationMetadata extends Model
{
    protected $fillable = [
        'voyage_location_id' , 'image_link'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function voyageLocation() {
        return $this->belongsTo(VoyageLocation::class);
    }
}
