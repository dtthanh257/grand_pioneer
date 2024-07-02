<?php

namespace Modules\Voyage\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class VoyageTimeline extends Model
{
    protected $fillable = [
        'voyage_id' , 'daytime', 'time', 'detail', 'language'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function voyage() {
        return $this->belongsTo(Voyage::class);
    }
}
