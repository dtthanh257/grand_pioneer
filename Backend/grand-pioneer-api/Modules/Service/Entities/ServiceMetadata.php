<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ServiceMetadata extends Model
{
    protected $fillable = [
        'service_id', 'image_link'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
