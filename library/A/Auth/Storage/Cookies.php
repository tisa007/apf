<?php
/**
 *           File:  Cookies.php
 *           Path:  ./A/Auth/Storage
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-01-24
 */
namespace A\Auth\Storage;
use A\Auth\Storage;

class Cookies implements Storage
{
    /**
     * _basename
     *
     * @var string
     */
    protected $_basename;

    /**
     * _identity
     *
     * @var string
     */
    protected $_identity = '';

    /**
     * _lifetime
     *
     * @var int
     */
    protected $_lifetime = 0;

    /**
     * __construct
     *
     * @param string $basename
     * @return void
     */
    public function __construct($basename = '__auth')
    {
        $this->_basename = (string)$basename;

        if (isset($_COOKIE[$this->_basename])
            && ($auth = explode('.', base64_decode((string)$_COOKIE[$this->_basename]), 3))
            && sizeof($auth) == 3 && $auth[0] === md5($auth[1] . ',' . $auth[2])
        )
        {
            $this->_lifetime = (int)$auth[1];
            $this->_identity = $auth[2];
        }
    }

    /**
     * setIdentity
     *
     * @param string $identity Must be encrypted, for greater security
     * @return bool
     */
    public function setIdentity($identity)
    {
        $scp = session_get_cookie_params();
        return @setcookie($this->_basename, base64_encode(implode('.', [
            md5($this->_lifetime . ',' . ($this->_identity = (string)$identity)),
            $this->_lifetime,
            $this->_identity,
        ])), $this->_lifetime, $scp['path'], $scp['domain'], $scp['secure'], $scp['httponly']);
    }

    /**
     * setLifetime
     *
     * @param int $lifetime
     * @return bool
     */
    public function setLifetime($lifetime)
    {
        $lifetime = (int)$lifetime;

        $scp = session_get_cookie_params();
        return @setcookie($this->_basename, base64_encode(implode('.', [
            md5(($this->_lifetime = $lifetime ? $lifetime + time() : 0) . ',' . $this->_identity),
            $this->_lifetime,
            $this->_identity,
        ])), $lifetime, $scp['path'], $scp['domain'], $scp['secure'], $scp['httponly']);
    }

    /**
     * getIdentity
     *
     * @return string
     */
    public function getIdentity()
    {
        return $this->_identity;
    }

    /**
     * getLifetime
     *
     * @return int
     */
    public function getLifetime()
    {
        return $this->_lifetime ? $this->_lifetime - time() : 0;
    }
}
// End of file : Cookies.php
