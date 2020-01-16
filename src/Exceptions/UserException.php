<?php
    namespace App\Exceptions;

	class UserException extends \Exception
	{
	    public function getStructMessage():string
            {
                return
                    "<b>Error</b>: '".parent::getMessage()."' => <b>".parent::getFile().
                    "</b> on line <b>".parent::getLine()."</b><br>";
            }
	}
