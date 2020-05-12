<?php

namespace taskForce\response\domain;

use DateTime;
use taskForce\share\StringHelper;
use taskForce\user\domain\User;

class Response
{
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
            'comment' => $this->comment,
            'price' => $this->price,
            'pastTime' => StringHelper::getPastTime($this->dateCreate),
            'user' => $this->user->toArray(),
        ];
    }
}
