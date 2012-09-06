<?php
/** 
 *           File:  Actors.php
 *           Path:  ./A/Mvc/Control
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-07-10
 */
namespace A\Mvc\Control;

class Actors extends \SplStack
{
    /**
     * _signal
     *
     * @var string
     */
    protected $_signal;

    /**
     * __construct
     *
     * @param mixed $signal
     * @param mixed $actors
     * @return void
     */
    public function __construct($signal, $actors = [])
    {
        $this->_signal = (string)$signal;
        foreach ($actors as $action)
        {
            $this->push($action);
        }
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->_signal;
    }

    /**
     * invoke
     *
     * @param mixed $sender
     * @param mixed $params
     * @return mixed
     */
    public function invoke($sender, $params)
    {
        if (!$this->isEmpty())
        {
            return call_user_func($this->pop(), $sender, $params, $this);
        }
    }
}
// End of file : Actors.php
