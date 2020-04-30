<?php

namespace  taskForce\response\domain;

use taskForce\share\BaseList;

class ResponsesList extends BaseList
{
    protected function validateItem($item): bool
    {
        return $item instanceof Response;
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
