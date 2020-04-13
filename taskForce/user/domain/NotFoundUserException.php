<?php

namespace taskForce\user\domain;

use yii\web\HttpException;
use Exception;

class NotFoundUserException extends HttpException
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct(404, $message, $code, $previous);
    }
}
