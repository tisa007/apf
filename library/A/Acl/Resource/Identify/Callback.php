<?php
/** 
 *           File:  Callback.php
 *           Path:  ./A/Acl/Resource/Identify
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-22
 */
namespace A\Acl\Resource\Identify;
use A\Acl\Resource\Identify;

class Callback implements Identify
{
    /**
     * _callback
     *
     * @var mixed
     */
    protected $_callback;

    /**
     * __construct
     *
     * @param mixed $callback
     * @return void
     */
    public function __construct($callback)
    {
        $this->setCallback($callback);
    }

    /**
     * getIdentity
     *
     * @return mixed
     */
    public function getCallback()
    {
        return $this->_callback;
    }

    /**
     * setCallback
     *
     * @param mixed $callback
     * @return void
     */
    public function setCallback($callback)
    {
        $this->_callback = $callback;
    }

    /**
     * identify
     *
     * @param mixed $resource
     * @return bool
     */
    public function identify($resource)
    {
        return (bool)call_user_func($this->_callback, $resource);
    }
}
// End of file : Callback.php
