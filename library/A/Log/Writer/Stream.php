<?php
/** 
 *           File:  Stream.php
 *           Path:  ./A/Log/Writer
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-12
 */
namespace A\Log\Writer;
use A\Log\Record;
use A\Log\Writer;

class Stream implements Writer
{
    /**
     * _source
     *
     * @var string
     */
    protected $_source;

    /**
     * __construct
     *
     * @param mixed $source
     * @return void
     */
    public function __construct($source)
    {
        if (is_resource($source))
        {
            if (get_resource_type($source) != 'stream')
            {
                throw new \InvalidArgumentException('Resource is not a stream');
            }

            $this->_source = $source;
        }
        else if (!($this->_source = @fopen($source, 'a', false)))
        {
            throw new \RuntimeException("{$source} cannot be opened with mode \"a\"");
        }
    }

    /**
     * write
     *
     * @param A\Log\Record $record
     * @return void
     */
    public function write(Record $record)
    {
        if (false === @fwrite($this->_source,
            $record->getClock() . ',' . $record->getLevel() . ',' . $record->getLabel() . ',' . $record->getEvent() . PHP_EOL
        ))
        {
            throw new \RuntimeException('Unable to write to stream');
        }
    }
}
// End of file : Stream.php
