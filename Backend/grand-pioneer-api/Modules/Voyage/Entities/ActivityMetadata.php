<?php

namespace Modules\Voyage\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ActivityMetadata extends Model
{
    protected $fillable = [
        'activity_id' , 'image_link'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function activity() {
        return $this->belongsTo(Activity::class);
    }
}
