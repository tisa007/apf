<?php
/**
 *           File:  Accessor.php
 *           Path:  ./A/Acl
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-01-27
 */
namespace A\Acl;

class Accessor
{
    /**
     * _identity
     *
     * @var string
     */
    protected $_identity;

    /**
     * _basename
     *
     * @var string
     */
    protected $_basename;

    /**
     * __construct
     *
     * @param string $identity
     * @param string $basename
     * @return void
     */
    public function __construct($identity, $basename = '')
    {
        $this->_identity = (string)$identity;
        $this->_basename = (string)$basename;
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->_basename . $this->_identity;
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
     * getBasename
     *
     * @return string
     */
    public function getBasename()
    {
        return $this->_basename;
    }
}
// End of file : Accessor.php
