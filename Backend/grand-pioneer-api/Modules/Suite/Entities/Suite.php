<?php

namespace Modules\Suite\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Vessel\Entities\Vessel;
use Modules\SuiteDetail\Entities\SuiteDetail;
use Modules\SuiteMetadata\Entities\SuiteMetadata;
use Modules\Suite\Entities\suiteType;

class Suite extends Model
{
    protected $fillable = [
        'title', 'content', 'vessel_id', 'suite_type_id', 'bed_number', 'suite_size', 'sundeck_size',
        'number_of_adult', 'number_of_children', 'number_of_bathroom', 'price', 'language'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function vessel() {
        return $this->belongsTo(Vessel::class);
    }

    public function suiteMetadata() {
        return $this->hasMany(suiteMetadata::class);
    }

    public function suiteType() {
        return $this->belongsTo(SuiteType::class);
    }
}
