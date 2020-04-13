<?php

namespace taskForce\task\domain;

use yii\web\HttpException;
use Exception;

class NotFoundTaskException extends HttpException
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct(404, $message, $code, $previous);
    }
}
