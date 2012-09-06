<?php
/** 
 *           File:  Process.php
 *           Path:  ./A/Mvc
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-06-12
 */
namespace A\Mvc;

interface Process
{
    /**
     * process
     *
     * @param A\Mvc\Request $request
     * @return A\Mvc\Respond
     */
    // public function process(Request $request = null);

    /**
     * process
     *
     * @return A\Mvc\Respond
     */
    public function process();
}
// End of file : Process.php
