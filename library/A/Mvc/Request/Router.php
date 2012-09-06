<?php
/** 
 *           File:  Router.php
 *           Path:  ./A/Mvc/Request
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-07-10
 */
namespace A\Mvc\Request;

class Router extends \SplObjectStorage
{
    /**
     * __construct
     *
     * @param mixed $routes
     * @return void
     */
    public function __construct($routes = [])
    {
        foreach ($routes as $route)
        {
            $this->attach($route);
        }
    }

    /**
     * route
     *
     * @param A\Mvc\Request\Source $source
     * @param mixed                $params
     * @return A\Mvc\Request\Params
     */
    public function route(Source $source, $params = [])
    {
        $params = new Params($params);
        foreach ($this as $route)
        {
            if ($route instanceof Router\Route ? $route->route($source, $params) : $route($source, $params))
            {
                break;
            }
        }

        return $params;
    }
}
// End of file : Router.php
