<?php

namespace taskForce\discussion\domain;

use taskForce\share\BaseList;

class DiscussionsList extends BaseList
{
    protected function validateItem($item): bool
    {
        return $item instanceof Discussion;
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
