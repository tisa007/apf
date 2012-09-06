<?php
/** 
 *           File:  Evaluate.php
 *           Path:  ./A/Acl/Resource
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-23
 */
namespace A\Acl\Resource;

interface Evaluate
{
    /**
     * evaluate
     *
     * @param mixed $pattern
     * @param mixed $subject
     * @return bool
     */
    public function evaluate($pattern, $subject);
}
// End of file : Evaluate.php
