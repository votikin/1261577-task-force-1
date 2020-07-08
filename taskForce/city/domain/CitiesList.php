<?php

namespace  taskForce\city\domain;

use taskForce\share\BaseList;

class CitiesList extends BaseList
{
    protected function validateItem($item): bool
    {
        return $item instanceof City;
    }

    public function toArray(): array
    {
        $list = [];
        foreach ($this->items as $item) {
            $list[] = $item->toArray();
        }

        return $list;
    }
}
