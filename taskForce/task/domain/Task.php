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
     * @var User
     */
    public $executor;

    /**
     * @var int
     */
    public $countResponses;

    /**
     * Task constructor.
     * @param int|null $id
     * @param string|null $shortName
     * @param string|null $description
     * @param string|null $address
     * @param int|null $budget
     * @param DateTime|null $deadline
     * @param DateTime|null $dateCreate
     * @param Category|null $category
     * @param Location|null $location
     * @param User|null $author
     * @param ImageList|null $images
     * @param Status|null $status
     * @param User|null $executor
     * @param int|null $countResponses
     */
    public function __construct(int $id = null, string $shortName = null, string $description = null,
                                string $address = null, int $budget = null, DateTime $deadline = null,
                                DateTime $dateCreate = null, Category $category = null, Location $location = null,
                                User $author = null, ImageList $images = null, Status $status = null,
                                User $executor = null, int $countResponses = null)
    {
        $this->id = $id;
        $this->shortName = $shortName;
        $this->description = $description;
        $this->address = $address;
        $this->budget = $budget;
        $this->deadline = $deadline;
        $this->dateCreate = $dateCreate;
        $this->category = $category;
        $this->location = $location;
        $this->author = $author;
        $this->images = $images;
        $this->status = $status;
        $this->executor = $executor;
        $this->countResponses = $countResponses;
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
            'executor' => $this->executor->toArray(),
            'countResponses' => $this->countResponses,
        ];
    }
}
