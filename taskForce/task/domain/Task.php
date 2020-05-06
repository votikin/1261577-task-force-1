<?php

namespace taskForce\task\domain;

use taskForce\category\domain\CategoriesList;
use DateTime;
use taskForce\share\StringHelper;
use taskForce\user\domain\UsersList;

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
    public $dateCreate;

    /**
     * @var CategoriesList
     */
    public $category;

    /**
     * @var Location
     */
    public $location;

    /**
     * @var UsersList
     */
    public $author;

    /**
     * @var ImageList
     */
    public $images;

    /**
     * Task constructor.
     */
    public function __construct()
    {
        $this->images = new ImageList();
    }

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
            'category' => $this->category->toArray(),
            'pastTime' => StringHelper::getPastTime($this->dateCreate),
            'author' => $this->author->toArray(),
            'images' => $this->images->toArray(),
        ];
    }
}
