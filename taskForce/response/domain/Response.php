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
    public $created_at;

    /**
     * @var User
     */
    public $user;

    public function toArray()
    {
        return [
            'comment' => $this->comment,
            'price' => $this->price,
            'pastTime' => StringHelper::getPastTime($this->created_at),
            'user' => $this->user,
        ];
    }
}
