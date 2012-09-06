<?php
/**
 *           File:  Failure.php
 *           Path:  ./A/Auth/Outcome
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2011-10-04
 */
namespace A\Auth\Outcome;
use A\Auth\Message;
use A\Auth\Outcome;

class Failure extends Outcome
{
    /**
     * __construct
     *
     * @param A\Auth\Message|string $message
     * @return void
     */
    public function __construct($message = null)
    {
        $message === null OR $this->_message = $message instanceof Message ? $message : new Message((string)$message);
    }
}
// End of file : Failure.php
