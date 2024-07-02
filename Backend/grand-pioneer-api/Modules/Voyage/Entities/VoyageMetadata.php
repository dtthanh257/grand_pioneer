<?php

namespace Modules\Voyage\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class VoyageMetadata extends Model
{
    protected $fillable = [
        'voyage_id' , 'image_link'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function voyage() {
        return $this->belongsTo(Voyage::class);
    }
}
