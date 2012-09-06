<?php
/**
 *           File:  Script.php
 *           Path:  ./A/View
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-03-04
 */
namespace A\View;

class Script
{
    /**
     * __invoke
     *
     * @param string $file
     * @param array  $vars
     * @return void
     */
    public function __invoke($file, array $vars = [])
    {
        if (!is_file($file) || !is_readable($file))
        {
            throw new \RuntimeException("Failed to read file \"$file\"");
        }

        unset($file, $vars);
        func_num_args() > 1 AND extract(func_get_arg(1), EXTR_SKIP);

        include func_get_arg(0);
    }
}
// End of file : Script.php
