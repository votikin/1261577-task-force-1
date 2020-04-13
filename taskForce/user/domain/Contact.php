<?php

namespace taskForce\user\domain;

class Contact
{
    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $skype;

    /**
     * @var string
     */
    public $email;

    /**
     * Contact constructor.
     * @param string|null $phone
     * @param string|null $skype
     * @param string|null $email
     */
    public function __construct(string $phone = null, string $skype = null, string $email = null)
    {
        $this->phone = $phone;
        $this->skype = $skype;
        $this->email = $email;
    }

}
