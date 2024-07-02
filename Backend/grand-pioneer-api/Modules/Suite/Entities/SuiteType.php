<?php

namespace Modules\Suite\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Suite\Entities\Suite;

class SuiteType extends Model
{
    protected $fillable = [
        'name', 'language'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function suite() {
        return $this->hasMany(Suite::class);
    }
}
