<?php

namespace taskForce\user\domain;

use taskForce\share\StringHelper;
use DateTime;

class Detail
{
    /**
     * @var string
     */
    public $about;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $age;

    /**
     * Detail constructor.
     * @param string|null $about
     * @param string|null $address
     * @param string|null $birthday
     */
    public function __construct(string $about = null, string $address = null, string $birthday = null)
    {
        $this->about = $about;
        $this->address = $address;
        if($birthday === null)
        {
            $birthday = date('Y-m-d');
        }
        $this->age = StringHelper::getAge(DateTime::createFromFormat('Y-m-d', $birthday));
    }

}
