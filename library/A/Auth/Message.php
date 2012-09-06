<?php
/**
 *           File:  Message.php
 *           Path:  ./A/Auth
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2011-08-11
 */
namespace A\Auth;

class Message
{
    /**
     * __construct
     *
     * @param string $message
     * @return void
     */
    public function __construct($message)
    {
        $this->_message = (string)$message;
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->_message;
    }
}
// End of file : Message.php
