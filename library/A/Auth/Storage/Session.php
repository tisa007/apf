<?php
/**
 *           File:  Session.php
 *           Path:  ./A/Auth/Storage
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-01-24
 */
namespace A\Auth\Storage;
use A\Auth\Storage;

class Session implements Storage
{
    const KEY_UID = 'A_AUTH_UID';
    const KEY_LIT = 'A_AUTH_LIT';

    /**
     * _basename
     *
     * @var string
     */
    protected $_basename;

    /**
     * __construct
     *
     * @param string $basename
     * @return void
     */
    public function __construct($basename = '__auth')
    {
        if (session_id() == '')
        {
            if (headers_sent($file, $line))
            {
                throw new \LogicException("Headers already sent in \"{$file}\" on line {$line}");
            }

            session_start();
        }

        $this->_basename = (string)$basename;
        if (isset($_SESSION) && !isset($_SESSION[$this->_basename]))
        {
            $_SESSION[$this->_basename] = [];
        }
    }

    /**
     * setIdentity
     *
     * @param string $identity
     * @return bool
     */
    public function setIdentity($identity)
    {
        if (isset($_SESSION[$this->_basename]) && is_array($_SESSION[$this->_basename]))
        {
            $_SESSION[$this->_basename][static::KEY_UID] = (string)$identity;
            return true;
        }

        return false;
    }

    /**
     * setLifetime
     *
     * @param int $lifetime
     * @return bool
     */
    public function setLifetime($lifetime)
    {
        if (isset($_SESSION[$this->_basename]) && is_array($_SESSION[$this->_basename]))
        {
            $lifetime = (int)$lifetime;

            if ($lifetime === 0)
            {
                unset($_SESSION[$this->_basename][static::KEY_LIT]);
            }
            else
            {
                $_SESSION[$this->_basename][static::KEY_LIT] = time() + $lifetime;
            }

            $scp = session_get_cookie_params();
            session_set_cookie_params($lifetime, $scp['path'], $scp['domain'], $scp['secure'], $scp['httponly']);

            return session_regenerate_id(true);
        }

        return false;
    }

    /**
     * getIdentity
     *
     * @return string
     */
    public function getIdentity()
    {
        return isset($_SESSION[$this->_basename][static::KEY_UID])
            ? (string)$_SESSION[$this->_basename][static::KEY_UID] : '';
    }

    /**
     * getLifetime
     *
     * @return int
     */
    public function getLifetime()
    {
        return isset($_SESSION[$this->_basename][static::KEY_LIT])
            ? (int)$_SESSION[$this->_basename][static::KEY_LIT] - time() : 0;
    }
}
// End of file : Session.php
