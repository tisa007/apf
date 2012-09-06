<?php
/**
 *           File:  Storage.php
 *           Path:  ./A/Auth
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2011-12-21
 */
namespace A\Auth;

interface Storage
{
    /**
     * setIdentity
     *
     * @param string $identity
     * @return bool
     */
    public function setIdentity($identity);

    /**
     * setLifetime
     *
     * @param int $lifetime
     * @return bool
     */
    public function setLifetime($lifetime);

    /**
     * getIdentity
     *
     * @return string
     */
    public function getIdentity();

    /**
     * getLifetime
     *
     * @return int
     */
    public function getLifetime();
}
// End of file : Storage.php
