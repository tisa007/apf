<?php
/** 
 *           File:  Suppress.php
 *           Path:  ./A/Log/Filter
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-11
 */
namespace A\Log\Filter;
use A\Log\Filter;
use A\Log\Record;

class Suppress implements Filter
{
    /**
     * _filter
     *
     * @var bool
     */
    protected $_filter = true;

    /**
     * filter
     *
     * @see A\Log\Filter::filter
     * @param A\Log\Record $record
     * @return bool
     */
    public function filter(Record $record)
    {
        return $this->_filter;
    }
}
// End of file : Suppress.php
