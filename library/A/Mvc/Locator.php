<?php
/** 
 *           File:  Locator.php
 *           Path:  ./A/Mvc
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-07-11
 */
namespace A\Mvc;

class Locator
{
    /**
     * detect
     *
     * @param A\Mvc\Context $context
     * @param A\Mvc\Message $message
     * @return callable
     */
    public function detect(Context $context, Message &$message = null)
    {
        $params = $context->getParams();
        $action = implode('\\', array_map('ucfirst', explode('/', empty($params['action']) ? 'index' : (string)$params['action'])));
        $module = ucfirst(isset($params['module']) ? (string)$params['module'] : 'class');

        if (!class_exists($process = $action . $module))
        {
            $message = new Message("Process \"{$process}\" was not found");
            return;
        }

        return function() use ($process, $context){return new $process($context);};
    }

    /**
     * locate
     *
     * @param A\Mvc\Context $context
     * @return mixed
     */
    public function locate(Context $context)
    {
        if ($builder = $this->detect($context, $message))
        {
            return call_user_func($builder);
        }

        throw $message;
    }
}
// End of file : Locator.php
