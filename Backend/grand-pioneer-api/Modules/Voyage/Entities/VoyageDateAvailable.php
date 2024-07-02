<?php

namespace Modules\Voyage\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class VoyageDateAvailable extends Model
{
    protected $fillable = [
        'voyage_id' , 'start_date', 'end_date'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function voyage() {
        return $this->belongsTo(Voyage::class);
    }
}
