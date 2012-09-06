<?php
/**
 *           File:  anchor.php
 *           Path:  ./A/View/Helper
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-02
 */
/**
 * @param array $args
 * @param mixed $base
 * @return string
 */
return function (array $args = [], $base = '')
{
    $base = (string)$base;
    if ($base == '')
    {
        $base = (string)A\Mvc::getInstance()->getContext()->getSource();
    }

    if ($base != '')
    {
        $segs = @parse_url($base);
        if (!empty($segs['query']))
        {
            $base = mb_substr($base, 0, strpos($base, '?'));
            foreach (explode('&', $segs['query']) as $seg)
            {
                list($key, $val) = explode('=', $seg, 2);
                array_key_exists($key, $args) OR $args[$key] = $val;
            }
        }
    }

    return rtrim(rtrim($base, '?') . (empty($args) ? '' : '?' . http_build_query($args)), '?');
};
// End of file : anchor.php
