<?php
/** 
 *           File:  Registry.php
 *           Path:  ./A/Acl
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-17
 */
namespace A\Acl;

class Registry
{
    /**
     * _exts
     *
     * @var array
     */
    protected $_exts = [];

    /**
     * _list
     *
     * @var array
     */
    protected $_list = [];

    /**
     * getExts
     *
     * @return array
     */
    public function getExts()
    {
        return $this->_exts;
    }

    /**
     * getList
     *
     * @return array
     */
    public function getList()
    {
        return $this->_list;
    }

    /**
     * extend
     *
     * @param mixed $accessor
     * @return A\Acl\Registry
     */
    public function extend($accessor)
    {
        array_unshift($this->_exts, $accessor);
        return $this;
    }

    /**
     * handle
     *
     * @param mixed $resource
     * @param mixed $decision
     * @return A\Acl\Registry
     */
    public function handle($resource, $decision)
    {
        array_unshift($this->_list, [$resource, $decision]);
        return $this;
    }

    /**
     * permit
     *
     * @param mixed $resource
     * @return A\Acl\Registry
     */
    public function permit($resource)
    {
        return $this->handle($resource, true);
    }

    /**
     * refuse
     *
     * @param mixed $resource
     * @return A\Acl\Registry
     */
    public function refuse($resource)
    {
        return $this->handle($resource, false);
    }
}
// End of file : Registry.php
