<?php
/** 
 *           File:  Target.php
 *           Path:  ./A/Mvc/Context
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-06-14
 */
namespace A\Mvc\Context;
use A\Mvc\Message;
use A\Mvc\Storage;

class Target extends Storage
{
    /**
     * __construct
     *
     * @param mixed $target
     * @return void
     */
    public function __construct($target)
    {
        if (is_string($target))
        {
            // scheme:action/action!method.format@module
            if (preg_match('#^
                (?<scheme>(?:[a-z][a-z0-9]*)?:)?
                (?:(?<action>[a-z][a-z0-9]*(?:/[a-z][a-z0-9]*)*))?
                (?<method>!(?:[a-z][a-z0-9]*)?)?
                (?<format>\.[a-z0-9]*)?
                (?<module>@[a-z0-9]*)?
                $#ix', $target, $result))
            {
                foreach ($result as $key => &$val)
                {
                    if (is_int($key) || $val == '')
                    {
                        unset($result[$key]);
                    }
                    else
                    {
                        $val = rtrim(ltrim($val, '!.@'), ':');
                    }
                }

                $target = $result;
            }
            else
            {
                throw new Message("\"{$target}\" is not a valid target string");
            }
        }

        parent::__construct($target);
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return (isset($this['scheme']) ? $this['scheme'] . ':' : '')
            . (isset($this['action']) ? $this['action'] : '')
            . (isset($this['method']) ? '!' . $this['method'] : '')
            . (isset($this['format']) ? '.' . $this['format'] : '')
            . (isset($this['module']) ? '@' . $this['module'] : '');
    }
}
// End of file : Target.php
