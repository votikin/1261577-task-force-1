<?php

namespace  taskForce\category\domain;

use taskForce\share\BaseList;

class CategoriesList extends BaseList
{
    protected function validateItem($item): bool
    {
        return $item instanceof Category;
    }

    public function toArray(): array
    {
        $list = [];
        foreach ($this->items as $item) {
            $list[] = $item->toArray();
        }

        return $list;
    }

    public function toIdKeyNameValueArray(): array
    {
        /**
         * @var $item Category
         */
        $list = [];
        foreach ($this->items as $item) {
            $list[$item->id] = $item->name;
        }

        return $list;
    }



}
