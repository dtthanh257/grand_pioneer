<?php

namespace Modules\SuiteMetadata\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Suite\Entities\Suite;

class SuiteMetadata extends Model
{
    protected $fillable = [
        'suite_id', 'image_link'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function suite() {
        return $this->belongsTo(Suite::class);
    }
}
