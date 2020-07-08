<?php

namespace taskForce\category\domain;

class Category
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
     * @var string
     */
    public $icon;

    /**
     * Category constructor.
     * @param int|null $id
     * @param string|null $name
     * @param string|null $icon
     */
    public function __construct(int $id = null, string $name = null, string $icon = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
        ];
    }

}
