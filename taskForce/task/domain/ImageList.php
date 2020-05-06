<?php

namespace  taskForce\task\domain;

use taskForce\task\domain\Image;
use taskForce\share\BaseList;

class ImageList extends BaseList
{
    protected function validateItem($item): bool
    {
        return $item instanceof Image;
    }

    public function toArray()
    {
        $list = [];
        foreach ($this->items as $item) {
            $list[] = $item->toArray();
        }

        return $list;
    }
}
