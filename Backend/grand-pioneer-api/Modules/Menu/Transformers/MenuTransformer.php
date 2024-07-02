<?php

namespace Modules\Menu\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Menu\Entities\Menu;

class MenuTransformer extends TransformerAbstract
{
    public function transform(Menu $menu)
    {
        return [
            'id' => $menu->id,
            'name' => $menu->name,
            'title' => $menu->title,
            'description' => $menu->description,
            'sub_title' => $menu->sub_title,
            'sub_description' => $menu->sub_description,
            'language' => $menu->language,
            'created_at' => $menu->created_at ? $menu->created_at->toDateTimeString() : null,
            'updated_at' => $menu->updated_at ? $menu->updated_at->toDateTimeString() : null,
        ];
    }
}
