<?php
/**
 *           File:  Auth.php
 *           Path:  ./A
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-01-24
 */
namespace A;
use A\Auth\Adapter;
use A\Auth\Outcome;
use A\Auth\Session;
use A\Auth\Storage;

class Auth
{
    /**
     * _storage
     *
     * @var A\Auth\Storage
     */
    protected $_storage;

    /**
     * __construct
     *
     * @param A\Auth\Storage $storage
     * @return void
     */
    public function __construct(Storage $storage = null)
    {
        $this->_storage = $storage ?: new Storage\Session;
    }

    /**
     * getStorage
     *
     * @return A\Auth\Storage
     */
    public function getStorage()
    {
        return $this->_storage;
    }

    /**
     * setStorage
     *
     * @param A\Auth\Storage $storage
     * @return void
     */
    public function setStorage(Storage $storage)
    {
        $this->_storage = $storage;
    }

    /**
     * verify
     *
     * @param A\Auth\Adapter $adapter
     * @return A\Auth\Outcome
     */
    public function verify(Adapter $adapter = null)
    {
        if ($adapter instanceof Adapter)
        {
            $outcome = $adapter->authenticate();
            $this->logout();

            if ($session = $outcome->getSession())
            {
                $this->_storage->setIdentity($session->getIdentity());
                $this->_storage->setLifetime($session->getLifetime());
            }
        }
        else
        {
            $outcome = ($identity = $this->_storage->getIdentity()) == '' || ($lifetime = $this->_storage->getLifetime()) < 0
                ? new Outcome\Failure
                : new Outcome\Success($identity, $lifetime);
        }

        return $outcome;
    }

    /**
     * logout
     *
     * @return bool
     */
    public function logout()
    {
        return $this->_storage->setIdentity('') || $this->_storage->setLifetime(-1);
    }

    /**
     * retain
     *
     * @param int $lifetime
     * @return bool
     */
    public function retain($lifetime)
    {
        return $this->_storage->setLifetime($lifetime);
    }
}
// End of file : Auth.php
