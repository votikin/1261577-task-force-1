<?php

namespace taskForce\task\domain;

class Location
{
    /**
     * @var string
     */
    public $latitude;

    /**
     * @var string
     */
    public $longitude;

    /**
     * Location constructor.
     * @param string|null $latitude
     * @param string|null $longitude
     */
    public function __construct(string $latitude = null, string $longitude = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

}
