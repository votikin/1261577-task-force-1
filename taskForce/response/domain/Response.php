<?php

namespace taskForce\response\domain;

use DateTime;
use taskForce\share\StringHelper;
use taskForce\user\domain\User;

class Response
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $comment;

    /**
     * @var int
     */
    public $price;

    /**
     * @var DateTime
     */
    public $dateCreate;

    /**
     * @var User
     */
    public $user;

    /**
     * @var bool
     */
    public $is_deleted;

    /**
     * @var int
     */
    public $taskId;

    /**
     * Response constructor.
     * @param User $user
     */
    public function __construct()
    {
        $this->user = new User();
    }


    public function toArray()
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'price' => $this->price,
            'pastTime' => StringHelper::getPastTime($this->dateCreate),
            'user' => $this->user->toArray(),
            'isDeleted' => $this->is_deleted,
        ];
    }
}
