<?php
/** 
 *           File:  Route.php
 *           Path:  ./A/Mvc/Request/Router
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-07-10
 */
namespace A\Mvc\Request\Router;
use A\Mvc\Request\Source;
use A\Mvc\Request\Params;

interface Route
{
    /**
     * route
     *
     * @param A\Mvc\Request\Source $source
     * @param A\Mvc\Request\Params $params
     * @return mixed If this is the last rule, return TRUE
     */
    public function route(Source $source, Params $params);
}
// End of file : Route.php
