<?php

namespace taskForce\task\domain;

use DateTime;
use taskForce\category\domain\Category;
use taskForce\share\StringHelper;
use taskForce\user\domain\User;

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
     * @var Category
     */
    public $category;

    /**
     * @var Location
     */
    public $location;

    /**
     * @var User
     */
    public $author;

    /**
     * @var ImageList
     */
    public $images;

    /**
     * @var Status
     */
    public $status;

    /**
     * Task constructor.
     */
    public function __construct()
    {
        $this->images = new ImageList();
        $this->category = new Category();
        $this->author = new User();
        $this->status = new Status();
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
            'status' => $this->status->toArray(),
        ];
    }
}
