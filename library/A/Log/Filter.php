<?php
/** 
 *           File:  Filter.php
 *           Path:  ./A/Log
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-11
 */
namespace A\Log;

interface Filter
{
    /**
     * filter
     * Returns FALSE to accept the message, TRUE to block it.
     *
     * @param A\Log\Record $record
     * @return bool
     */
    public function filter(Record $record);
}
// End of file : Filter.php
