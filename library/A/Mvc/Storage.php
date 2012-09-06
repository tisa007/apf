<?php
/** 
 *           File:  Storage.php
 *           Path:  ./A/Mvc
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-07-11
 */
namespace A\Mvc;

class Storage extends \ArrayObject
{
    /**
     * offsetGet
     *
     * @param mixed $index
     * @return mixed
     */
    public function offsetGet($index)
    {
        return $this->offsetExists($index) ? parent::offsetGet($index) : null;
    }
}
// End of file : Storage.php
