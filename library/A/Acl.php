<?php
/** 
 *           File:  Acl.php
 *           Path:  ./A
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-25
 */
namespace A;
use A\Acl\Registry;
use A\Acl\Resource;

class Acl
{
    /**
     * _acl
     *
     * @var array
     */
    protected $_acl = [];

    /**
     * _registryDiscover
     *
     * @var A\Acl\Registry\Discover
     */
    protected $_registryDiscover;

    /**
     * _resourceEvaluate
     *
     * @var A\Acl\Resource\Evaluate
     */
    protected $_resourceEvaluate;

    /**
     * __construct
     *
     * @param A\Acl\Registry\Discover $discover
     * @param A\Acl\Resource\Evaluate $evaluate
     * @return void
     */
    public function __construct(Registry\Discover $discover = null, Resource\Evaluate $evaluate = null)
    {
        $this->_registryDiscover = $discover;
        $this->_resourceEvaluate = $evaluate;
    }

    /**
     * setRegistryDiscover
     *
     * @param A\Acl\Registry\Discover $discover
     * @return void
     */
    public function setRegistryDiscover(Registry\Discover $discover)
    {
        $this->_registryDiscover = $discover;
    }

    /**
     * getRegistryDiscover
     *
     * @return A\Acl\Registry\Discover
     */
    public function getRegistryDiscover()
    {
        return $this->_registryDiscover;
    }

    /**
     * setResourceEvaluate
     *
     * @param A\Acl\Resource\Evaluate $evaluate
     * @return void
     */
    public function setResourceEvaluate(Resource\Evaluate $evaluate)
    {
        $this->_resourceEvaluate = $evaluate;
    }

    /**
     * getResourceEvaluate
     *
     * @return A\Acl\Resource\Evaluate
     */
    public function getResourceEvaluate()
    {
        return $this->_resourceEvaluate ?: ($this->_resourceEvaluate = new Resource\Evaluate\Location);
    }

    /**
     * verify
     *
     * @param mixed $accessor
     * @param mixed $resource
     * @param mixed $autoload
     * @return bool
     */
    public function verify($accessor, $resource, $autoload = true)
    {
        if ($registry = $this->locate($accessor, $autoload))
        {
            foreach ($registry->getList() as $lst)
            {
                if ($lst[0] instanceof Resource\Identify ? $lst[0]->identify($resource)
                    : $this->getResourceEvaluate()->evaluate($lst[0], $resource))
                {
                    if (is_bool($decision = $lst[1]) || is_bool($decision = call_user_func($decision, $accessor, $resource)))
                    {
                        return $decision;
                    }
                }
            }

            foreach ($registry->getExts() as $ext)
            {
                if (is_bool($decision = $this->verify($ext, $resource, $autoload)))
                {
                    return $decision;
                }
            }
        }
    }

    /**
     * locate
     *
     * @param mixed $accessor
     * @param mixed $autoload
     * @return A\Acl\Registry
     */
    public function locate($accessor, $autoload = true)
    {
        if (array_key_exists((string)$accessor, $this->_acl))
        {
            return $this->_acl[(string)$accessor];
        }

        if ($autoload && ($discover = $autoload instanceof Registry\Discover ? $autoload : $this->getRegistryDiscover()))
        {
            if ($registry = $discover->discover($accessor))
            {
                return $this->create($accessor, $registry);
            }
        }
    }

    /**
     * create
     *
     * @param mixed          $accessor
     * @param A\Acl\Registry $registry
     * @return A\Acl\Registry
     */
    public function create($accessor, Registry $registry = null)
    {
        return $this->_acl[(string)$accessor] = $registry ?: new Registry;
    }

    /**
     * delete
     *
     * @param mixed $accessor
     * @return A\Acl
     */
    public function delete($accessor)
    {
        unset($this->_acl[(string)$accessor]);
        return $this;
    }
}
// End of file : Acl.php
