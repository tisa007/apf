<?php
/** 
 *           File:  Control.php
 *           Path:  ./A/Mvc
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-06-11
 */
namespace A\Mvc;

interface Control
{
    /**
     * control
     *
     * @param A\Mvc\Process $process
     * @param array         $options
     * @return mixed
     */
    public function control(Process $process, array $options = []);
}
// End of file : Control.php
