<?php

namespace taskForce\user\domain;

use DateTime;
use taskForce\category\domain\CategoriesList;
use taskForce\share\StringHelper;

class User
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $avatar;

    /**
     * @var string
     */
    public $name;

    /**
     * @var DateTime
     */
    public $dateCreate;

    /**
     * @var Contact
     */
    public $contacts;

    /**
     * @var DateTime
     */
    public $lastActivity;

    /**
     * @var double
     */
    public $rating;

    /**
     * @var CategoriesList
     */
    public $categories;

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

    /**
     * User constructor.
     * @param int|null $id
     * @param string|null $avatar
     * @param string|null $name
     * @param DateTime|null $dateCreate
     * @param Contact|null $contacts
     * @param DateTime|null $lastActivity
     * @param float|null $rating
     * @param CategoriesList|null $categories
     * @param Detail|null $detail
     * @param int|null $cityId
     */
    public function __construct(int $id = null, string $avatar = null, string $name = null, DateTime $dateCreate = null,
                                Contact $contacts = null, DateTime $lastActivity = null, float $rating = null,
                                CategoriesList $categories = null, Detail $detail = null, int $cityId = null)
    {
        $this->id = $id;
        $this->avatar = $avatar;
        $this->name = $name;
        $this->dateCreate = $dateCreate;
        $this->contacts = $contacts;
        $this->lastActivity = $lastActivity;
        $this->rating = $rating;
        $this->categories = $categories;
        $this->detail = $detail;
        $this->cityId = $cityId;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'avatar' => $this->avatar,
            'name' => $this->name,
            'registrationPast' => StringHelper::getRegistrationPastTime($this->dateCreate),
            'contacts' => $this->contacts->toArray(),
            'pastTime' => StringHelper::getPastActivityTime($this->lastActivity),
            'rating' => $this->rating,
            'categories' => $this->categories->toArray(),
            'detail' => $this->detail->toArray(),
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
