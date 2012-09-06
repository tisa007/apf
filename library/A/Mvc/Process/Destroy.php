<?php
/** 
 *           File:  Destroy.php
 *           Path:  ./A/Mvc/Process
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-06-13
 */
namespace A\Mvc\Process;

class Destroy extends \RuntimeException
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(get_class($this));
    }
}
// End of file : Destroy.php
