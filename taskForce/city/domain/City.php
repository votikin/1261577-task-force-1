<?php

namespace taskForce\city\domain;

class City
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];

    }
}
