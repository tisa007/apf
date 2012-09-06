<?php
/** 
 *           File:  Record.php
 *           Path:  ./A/Log
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-11
 */
namespace A\Log;

class Record
{
    /**
     * _ctime
     *
     * @var int 
     */
    protected $_ctime;

    /**
     * _clock
     *
     * @var string
     */
    protected $_clock;

    /**
     * _event
     *
     * @var string
     */
    protected $_event;

    /**
     * _label
     *
     * @var string
     */
    protected $_label;

    /**
     * _level
     *
     * @var int
     */
    protected $_level;

    /**
     * __construct
     *
     * @param mixed $event
     * @param mixed $level
     * @param mixed $label
     * @return void
     */
    public function __construct($event, $level, $label)
    {
        $this->setCtime(time());
        $this->setEvent($event);
        $this->setLabel($label);
        $this->setLevel($level);
    }

    /**
     * getCtime
     *
     * @return int
     */
    public function getCtime()
    {
        return $this->_ctime;
    }

    /**
     * setCtime
     *
     * @param int $ctime
     * @return void
     */
    public function setCtime($ctime)
    {
        $this->_ctime = (int)$ctime;
    }

    /**
     * getClock
     *
     * @return string
     */
    public function getClock()
    {
        return $this->_clock ?: ($this->_clock = date('c', $this->_ctime));
    }

    /**
     * setClock
     *
     * @param string $clock
     * @return void
     */
    public function setClock($clock)
    {
        $this->_clock = (string)$clock;
    }

    /**
     * getEvent
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->_event;
    }

    /**
     * setEvent
     *
     * @param string $event
     * @return void
     */
    public function setEvent($event)
    {
        $this->_event = (string)$event;
    }

    /**
     * getLabel
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->_label;
    }

    /**
     * setLabel
     *
     * @param string $label
     * @return void
     */
    public function setLabel($label)
    {
        $this->_label = (string)$label;
    }

    /**
     * getLevel
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->_level;
    }

    /**
     * setLevel
     *
     * @param int $level
     * @return void
     */
    public function setLevel($level)
    {
        $this->_level = (int)$level;
    }
}
// End of file : Record.php
