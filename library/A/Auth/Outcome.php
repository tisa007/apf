<?php
/**
 *           File:  Outcome.php
 *           Path:  ./A/Auth
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-01-23
 */
namespace A\Auth;

class Outcome
{
    /**
     * _message
     *
     * @var A\Auth\Message
     */
    protected $_message;

    /**
     * _session
     *
     * @var A\Auth\Session
     */
    protected $_session;

    /**
     * setMessage
     *
     * @param A\Auth\Message $message
     * @return void
     */
    public function setMessage(Message $message)
    {
        $this->_message = $message;
    }

    /**
     * setSession
     *
     * @param A\Auth\Session $session
     * @return void
     */
    public function setSession(Session $session)
    {
        $this->_session = $session;
    }

    /**
     * getMessage
     *
     * @return A\Auth\Message
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * getSession
     *
     * @return A\Auth\Session
     */
    public function getSession()
    {
        return $this->_session;
    }
}
// End of file : Outcome.php
