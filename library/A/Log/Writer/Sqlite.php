<?php
/** 
 *           File:  Sqlite.php
 *           Path:  ./A/Log/Writer
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-11
 */
namespace A\Log\Writer;
use A\Log\Record;
use A\Log\Writer;

class Sqlite implements Writer
{
    /**
     * _source
     *
     * @var PDO
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
        $this->_source = ($source instanceof \PDO) ? $source : new \PDO("sqlite:{$source}");
        $this->_source->exec(
            'CREATE TABLE IF NOT EXISTS "log" (
                "ctime" INTEGER,
                "level" INTEGER,
                "label" TEXT,
                "event" TEXT,
                "clock" DATETIME
            );'
        );
    }

    /**
     * write
     *
     * @param A\Log\Record $record
     * @return void
     */
    public function write(Record $record)
    {
        $this->_source->exec(sprintf(
            'INSERT INTO log (ctime, level, label, event, clock) VALUES (%d, %d, %s, %s, %s)',
            $record->getCtime(),
            $record->getLevel(),
            $this->_source->quote($record->getLabel()),
            $this->_source->quote($record->getEvent()),
            $this->_source->quote($record->getClock())
        ));
    }
}
// End of file : Sqlite.php
