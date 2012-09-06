<?php
/** 
 *           File:  Identify.php
 *           Path:  ./A/Acl/Resource
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-17
 */
namespace A\Acl\Resource;

interface Identify
{
    /**
     * identify
     *
     * @param mixed $resource
     * @return bool
     */
    public function identify($resource);
}
// End of file : Identify.php
