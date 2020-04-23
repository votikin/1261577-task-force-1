<?php

namespace  taskForce\task\domain;

use taskForce\share\BaseList;

class TasksList extends BaseList
{
    protected function validateItem($item): bool
    {
        return $item instanceof Task;
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
