<?php

namespace taskForce\task\domain;

use taskForce\category\domain\Category;
use DateTime;
use taskForce\share\StringHelper;

class Task
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $shortName;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $address;

    /**
     * @var int
     */
    public $budget;

    /**
     * @var DateTime
     */
    public $deadline;

    /**
     * @var DateTime
     */
    public $created_at;

    /**
     * @var Category
     */
    public $category;

    /**
     * @var location
     */
    public $location;


    public function toArray()
    {
        return [
            'id' => $this->id,
            'short' => $this->shortName,
            'description' => $this->description,
            'address' => $this->address,
            'budget' => $this->budget,
            'deadline' => $this->deadline,
            'location' => $this->location,
            'category' => $this->category,
            'pastTime' => StringHelper::getPastTime($this->created_at),
        ];
    }
}
