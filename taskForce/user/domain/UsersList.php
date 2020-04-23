<?php

namespace  taskForce\user\domain;

use taskForce\share\BaseList;

class UsersList extends BaseList
{
    protected function validateItem($item): bool
    {
        return $item instanceof User;
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
