<?php
/** 
 *           File:  Master.php
 *           Path:  ./A/Mvc/Control
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-06-12
 */
namespace A\Mvc\Control;
use A\Mvc\Storage;

class Master extends Storage
{
    /**
     * master
     *
     * @param mixed $object
     * @return void
     */
    public function master($object)
    {
        foreach ($this as $args)
        {
            if (!empty($args) && is_array($args))
            {
                $func = array_shift($args);
                call_user_func_array([$object, $func], $args);
            }
        }
    }
}
// End of file : Master.php
