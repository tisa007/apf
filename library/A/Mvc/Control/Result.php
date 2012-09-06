<?php
/** 
 *           File:  Result.php
 *           Path:  ./A/Mvc/Control
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-06-14
 */
namespace A\Mvc\Control;

class Result
{
    /**
     * _result
     *
     * @var mixed
     */
    protected $_result;

    /**
     * __construct
     *
     * @param mixed $result
     * @return void
     */
    public function __construct($result)
    {
        $this->_result = $result;
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->_result;
    }

    /**
     * getResult
     *
     * @return mixed
     */
    public function getResult()
    {
        return $this->_result;
    }

    /**
     * setResult
     *
     * @param mixed $result
     * @return void
     */
    public function setResult($result)
    {
        $this->_result = $result;
    }
}
// End of file : Result.php
