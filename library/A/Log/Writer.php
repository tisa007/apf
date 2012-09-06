<?php
/** 
 *           File:  Writer.php
 *           Path:  ./A/Log
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-11
 */
namespace A\Log;

interface Writer
{
    /**
     * write
     *
     * @param A\Log\Record $record
     * @return void
     */
    public function write(Record $record);
}
// End of file : Writer.php
