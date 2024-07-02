<?php

namespace Modules\Voyage\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class VoyageLocation extends Model
{
    protected $fillable = [
        'voyage_id' , 'title', 'sub_title', 'description', 'language'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function voyage() {
        return $this->belongsTo(Voyage::class);
    }

    public function voyageLocationMetadata() {
        return $this->hasMany(VoyageLocationMetadata::class);
    }
}
