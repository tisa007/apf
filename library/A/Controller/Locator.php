<?php
/** 
 *           File:  Locator.php
 *           Path:  ./A/Controller
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-05-21
 */
namespace A\Controller;
use A\Mvc\Context;

class Locator extends \A\Mvc\Locator
{
    /**
     * detect
     *
     * @param A\Mvc\Context $context
     * @param mixed         $message
     * @return callable
     */
    public function detect(Context $context, &$message = null)
    {
    }
}
// End of file : Locator.php
