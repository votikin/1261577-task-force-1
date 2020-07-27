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

    /**
     * City constructor.
     * @param int|null $id
     * @param string|null $name
     */
    public function __construct(int $id = null, string $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];

    }
}
