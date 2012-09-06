<?php
/** 
 *           File:  Discover.php
 *           Path:  ./A/Acl/Registry
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-17
 */
namespace A\Acl\Registry;

interface Discover
{
    /**
     * discover
     *
     * @param mixed $accessor
     * @return A\Acl\Registry
     */
    public function discover($accessor);
}
// End of file : Discover.php
