<?php

namespace Modules\Menu\Repositories;

use Modules\Menu\Entities\Menu;
use Prettus\Repository\Eloquent\BaseRepository;

class MenuRepository extends BaseRepository
{
    public function model() {
        return Menu::class;
    }

    public function find($id, $column = ['*']) {
        return parent::find($id, $column);
    }
}