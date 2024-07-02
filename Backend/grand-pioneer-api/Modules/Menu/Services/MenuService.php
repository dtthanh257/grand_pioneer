<?php

namespace Modules\Menu\Services;

use Carbon\Carbon;
use Modules\Menu\Entities\Menu;

class MenuService {
    protected $menu;

    protected $attributes = [];

    public function __construct($menu = null)
    {
        $this->menu = $menu;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function save() {
        $attributes = $this->attributes;

        if(!$this->menu) {
            $this->menu = new Menu();
        }

        $this->menu->fill($this->attributes);
        $this->menu->save();

        return $this->menu;
    }
}