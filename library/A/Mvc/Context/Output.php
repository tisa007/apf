<?php
/** 
 *           File:  Output.php
 *           Path:  ./A/Mvc/Context
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-07-11
 */
namespace A\Mvc\Context;
use A\Mvc\Respond;

class Output extends \ArrayObject implements Respond
{
    /**
     * respond
     *
     * @return void
     */
    public function respond()
    {
        foreach ($this as &$val)
        {
            if ($val instanceof Respond)
            {
                $val->respond();
            }
            else
            {
                echo $val;
            }
        }
    }
}
// End of file : Output.php
