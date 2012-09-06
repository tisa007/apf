<?php
/** 
 *           File:  Log.php
 *           Path:  ./A
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-16
 */
namespace A;
use A\Log\Filter;
use A\Log\Record;
use A\Log\Writer;

class Log
{
    const EMERG   = 0;  // Emergency: system is unusable
    const ALERT   = 1;  // Alert: action must be taken immediately
    const CRIT    = 2;  // Critical: critical conditions
    const ERR     = 3;  // Error: error conditions
    const WARN    = 4;  // Warning: warning conditions
    const NOTICE  = 5;  // Notice: normal but significant condition
    const INFO    = 6;  // Informational: informational messages
    const DEBUG   = 7;  // Debug: debug messages

    /**
     * _signals
     *
     * @var array
     */
    protected $_signals;

    /**
     * _writers
     *
     * @var array
     */
    protected $_writers = [];

    /**
     * _filters
     *
     * @var array
     */
    protected $_filters = [];

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->_signals = array_flip(call_user_func([new \ReflectionClass($this), 'getConstants']));
    }

    /**
     * write
     *
     * @param mixed $event
     * @param mixed $level
     * @return void
     */
    public function write($event, $level)
    {
        if (!isset($this->_signals[$level]))
        {
            throw new \InvalidArgumentException('Bad log priority');
        }

        $record = new Record($event, $level, $this->_signals[$level]);

        foreach ($this->_filters as $filter)
        {
            if ($filter->filter($record))
            {
                return;
            }
        }

        foreach ($this->_writers as $writer)
        {
            $writer->write($record);
        }
    }

    /**
     * emerg
     *
     * @param mixed $event
     * @return void
     */
    public function emerg($event)
    {
        $this->write($event, static::EMERG);
    }

    /**
     * alert
     *
     * @param mixed $event
     * @return void
     */
    public function alert($event)
    {
        $this->write($event, static::ALERT);
    }

    /**
     * crit
     *
     * @param mixed $event
     * @return void
     */
    public function crit($event)
    {
        $this->write($event, static::CRIT);
    }

    /**
     * err
     *
     * @param mixed $event
     * @return void
     */
    public function err($event)
    {
        $this->write($event, static::ERR);
    }

    /**
     * warn
     *
     * @param mixed $event
     * @return void
     */
    public function warn($event)
    {
        $this->write($event, static::WARN);
    }

    /**
     * notice
     *
     * @param mixed $event
     * @return void
     */
    public function notice($event)
    {
        $this->write($event, static::NOTICE);
    }

    /**
     * info
     *
     * @param mixed $event
     * @return void
     */
    public function info($event)
    {
        $this->write($event, static::INFO);
    }

    /**
     * debug
     *
     * @param mixed $event
     * @return void
     */
    public function debug($event)
    {
        $this->write($event, static::DEBUG);
    }

    /**
     * addWriter
     *
     * @param A\Log\Writer $writer
     * @return void
     */
    public function addWriter(Writer $writer)
    {
        $this->_writers[spl_object_hash($writer)] = $writer;
    }

    /**
     * addFilter
     *
     * @param A\Log\Filter $filter
     * @return void
     */
    public function addFilter(Filter $filter)
    {
        $this->_filters[spl_object_hash($filter)] = $filter;
    }
}
// End of file : Log.php
