<?php

namespace Modules\Voyage\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'voyage_id' , 'title', 'content', 'language'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function voyage() {
        return $this->belongsTo(Voyage::class);
    }

    public function activityMetadata() {
        return $this->hasMany(ActivityMetadata::class);
    }
}
