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
    public function __construct(string $email = null, string $phone = null, string $skype = null)
    {
        $this->phone = $phone;
        $this->skype = $skype;
        $this->email = $email;
    }

    public function toArray()
    {
        return [
            'phone' => $this->phone,
            'skype' => $this->skype,
            'email' => $this->email,
        ];
    }

}
