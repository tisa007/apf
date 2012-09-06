<?php
/**
 *           File:  escape.php
 *           Path:  ./A/View/Helper
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-03-13
 */
/**
 * @param mixed $var
 * @return string
 */
return function ($var)
{
    return htmlspecialchars($var, ENT_COMPAT);
};
// End of file : escape.php
