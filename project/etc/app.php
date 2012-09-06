<?php
return call_user_func(function($env, $etc = array())
{
    $etc['product'] = array(
    );

    $etc['develop'] = array(
    );

    $etc['testing'] = array(
    );

    return $etc[$env];
}, defined('APP_ENV') ? APP_ENV : 'product');
// End of file : etc.php
