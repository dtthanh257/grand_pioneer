<?php

namespace Modules\Vessel\Services;

use Carbon\Carbon;
use Modules\Vessel\Entities\Vessel;

class VesselService {
    protected $vessel;

    protected $attributes = [];

    public function __construct($vessel = null)
    {
        $this->vessel = $vessel;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function save() {
        $attributes = $this->attributes;

        if(!$this->vessel) {
            $this->vessel = new Vessel();
        }

        $this->vessel->fill($this->attributes);
        $this->vessel->save();

        return $this->vessel;
    }
}