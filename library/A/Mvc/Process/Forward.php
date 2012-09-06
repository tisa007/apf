<?php
/** 
 *           File:  Forward.php
 *           Path:  ./A/Mvc/Process
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-06-13
 */
namespace A\Mvc\Process;

class Forward extends \RuntimeException
{
    /**
     * _target
     *
     * @var mixed
     */
    protected $_target;

    /**
     * __construct
     *
     * @param mixed $target
     * @return void
     */
    public function __construct($target)
    {
        $this->_target = $target; parent::__construct(get_class($this));
    }

    /**
     * getTarget
     *
     * @return mixed
     */
    public function getTarget()
    {
        return $this->_target;
    }

    /**
     * setTarget
     *
     * @param mixed $target
     * @return void
     */
    public function setTarget($target)
    {
        $this->_target = $target;
    }
}
// End of file : Forward.php
