<?php
/**
 *           File:  Success.php
 *           Path:  ./A/Auth/Outcome
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2011-10-04
 */
namespace A\Auth\Outcome;
use A\Auth\Message;
use A\Auth\Outcome;
use A\Auth\Session;

class Success extends Outcome
{
    /**
     * __construct
     *
     * @param string                $identity
     * @param int                   $lifetime
     * @param A\Auth\Message|string $messages
     * @return void
     */
    public function __construct($identity, $lifetime, $messages = null)
    {
        $this->_session = new Session($identity, $lifetime);
        $messages === null OR $this->_message = $messages instanceof Message ? $messages : new Message((string)$messages);
    }
}
// End of file : Success.php
