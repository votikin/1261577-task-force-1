<?php

namespace  taskForce\review\domain;

use taskForce\share\BaseList;

class ReviewsList extends BaseList
{
    protected function validateItem($item): bool
    {
        return $item instanceof Review;
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
