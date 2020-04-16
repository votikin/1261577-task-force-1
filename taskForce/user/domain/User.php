<?php

namespace taskForce\user\domain;

use DateTime;
use taskForce\category\domain\Category;
use taskForce\share\StringHelper;

class User
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var
     */
    public $avatar;

    /**
     * @var string
     */
    public $name;

    /**
     * @var DateTime
     */
    public $created_at;

    /**
     * @var Contact
     */
    public $contacts;

    /**
     * @var DateTime
     */
    public $last_activity;

    /**
     * @var double
     */
    public $rating;

    /**
     * @var Category[]
     */
    public $category;

    /**
     * @var Detail
     */
    public $detail;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    public $cityId;

    public function toArray()
    {
        return [
            'id' => $this->id,
            'avatar' => $this->avatar,
            'name' => $this->name,
            'registrationPast' => StringHelper::getRegistrationPastTime($this->created_at),
            'contacts' => $this->contacts,
            'pastTime' => StringHelper::getPastActivityTime($this->last_activity),
            'rating' => $this->rating,
            'categories' => $this->category,
            'detail' => $this->detail,
            'city_id' => $this->cityId,
        ];
    }

    /**
     * @param string $pass
     */
    public function setPassword(string $pass)
    {
        $this->password = $pass;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
