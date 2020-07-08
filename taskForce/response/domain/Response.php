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
     * @param int|null $id
     * @param string|null $comment
     * @param int|null $price
     * @param DateTime|null $dateCreate
     * @param User|null $user
     * @param bool|null $is_deleted
     * @param int|null $taskId
     */
    public function __construct(int $id = null, string $comment = null, int $price = null, DateTime $dateCreate = null,
                                User $user = null, bool $is_deleted = null, int $taskId = null)
    {
        $this->id = $id;
        $this->comment = $comment;
        $this->price = $price;
        $this->dateCreate = $dateCreate;
        $this->user = $user;
        $this->is_deleted = $is_deleted;
        $this->taskId = $taskId;
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
