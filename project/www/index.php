<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('PRC');

define('LIB_DIR'    , dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR);
define('PRO_DIR'    , dirname(__DIR__) . DIRECTORY_SEPARATOR);

define('PRO_DIR_APP', PRO_DIR . 'app' . DIRECTORY_SEPARATOR);
define('PRO_DIR_BIN', PRO_DIR . 'bin' . DIRECTORY_SEPARATOR);
define('PRO_DIR_DOC', PRO_DIR . 'doc' . DIRECTORY_SEPARATOR);
define('PRO_DIR_ETC', PRO_DIR . 'etc' . DIRECTORY_SEPARATOR);
define('PRO_DIR_LIB', PRO_DIR . 'lib' . DIRECTORY_SEPARATOR);
define('PRO_DIR_TMP', PRO_DIR . 'tmp' . DIRECTORY_SEPARATOR);
define('PRO_DIR_VAR', PRO_DIR . 'var' . DIRECTORY_SEPARATOR);
define('PRO_DIR_WWW', PRO_DIR . 'www' . DIRECTORY_SEPARATOR);

set_include_path(LIB_DIR . PATH_SEPARATOR . get_include_path());
set_include_path(PRO_DIR_LIB . PATH_SEPARATOR . get_include_path());

require_once 'A.php';
spl_autoload_register('A::loader');

$setting = new A\Mvc\Setting(require_once PRO_DIR_ETC . 'app.php');
$request = new A\Mvc\Request(new A\Mvc\Request\Source, new A\Mvc\Request\Router(
    $setting['a.mvc.request.router.routes'] ?: []
));

$request->attach('ready', function($request) use ($setting) {
    A\Mvc::getInstance()->setSetting($setting);
    A\Mvc::getInstance()->setContext(
        new A\Mvc\Context($request->getSource(), $request->getRouter(), $request->getParams())
    );

    A\Mvc::getInstance()->process();
});

return $request();
// End of file : index.php
