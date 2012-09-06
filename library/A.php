<?php
/** 
 *           File:  A.php
 *           Path:  ./
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-09-01
 */
class A
{
    /**
     * Version of APF
     */
    const VERSION = '1.4.0';

    /**
     * Usage: spl_autoload_register('A::loader');
     *
     * @param string $name
     * @param string $path
     * @param string $tail
     * @return bool
     */
    public static function loader($name, $path = null, $tail = '.php')
    {
        if (class_exists($name, false) || trait_exists($name, false) || interface_exists($name, false))
        {
            return true;
        }

        if ($name == '' || preg_match('/[^a-z0-9_\\\\]/i', $name))
        {
            return false;
        }

        static $load;
        $load === null AND $load = function(){include_once func_get_arg(0);};

        $file = ltrim(str_replace(['_', '\\'], DIRECTORY_SEPARATOR, $name), DIRECTORY_SEPARATOR) . $tail;
        $path === null OR $file = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file;

        if ($fp = @fopen($file, 'r', ($path === null)))
        {
            @fclose($fp);
            $load($file);

            if (class_exists($name, false) || trait_exists($name, false) || interface_exists($name, false))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * import
     *
     * @throw RuntimeException if failed to import the package
     * @param string $name
     * @param string $path
     * @param string $tail
     * @return void
     */
    public static function import($name, $path = null, $tail = '.php')
    {
        if (!static::loader($name, $path, $tail))
        {
            throw new RuntimeException("Failed to import \"{$name}\"");
        }
    }

    /**
     * locate
     *
     * @param string $name
     * @return mixed
     */
    public static function locate($name)
    {
        // TODO: locate object with params injection...
        return new $name;
    }

    /**
     * object
     *
     * @param string $name
     * @return mixed
     */
    public static function object($name)
    {
        static $objs = [];
        $name = strtolower($name);

        if (func_num_args() > 1)
        {
            return $objs[$name] = func_get_arg(1);
        }

        return isset($objs[$name]) ? $objs[$name] : ($objs[$name] = static::locate($name));
    }
}
// End of file : A.php
