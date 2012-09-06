<?php
/** 
 *           File:  Request.php
 *           Path:  ./A/Mvc
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-07-31
 */
namespace A\Mvc;
use A\Mvc\Request\Params;
use A\Mvc\Request\Router;
use A\Mvc\Request\Source;

class Request
{
    use Subject;

    /**
     * _params
     *
     * @var A\Mvc\Request\Params
     */
    protected $_params;

    /**
     * _router
     *
     * @var A\Mvc\Request\Router
     */
    protected $_router;

    /**
     * _source
     *
     * @var A\Mvc\Request\Source
     */
    protected $_source;

    /**
     * __construct
     *
     * @param A\Mvc\Request\Source $source
     * @param A\Mvc\Request\Router $router
     * @return void
     */
    public function __construct(Source $source = null, Router $router = null)
    {
        $this->_source = $source;
        $this->_router = $router;
    }

    /**
     * __invoke
     *
     * @return void
     */
    public function __invoke()
    {
        $this->notify('route');

        $this->invoke(['request' => function($sender, $params) {
            $sender->setParams($sender->getRouter()->route($sender->getSource(), $params));
        }]);

        $this->notify('ready');
    }

    /**
     * getParams
     *
     * @return A\Mvc\Request\Params
     */
    public function getParams()
    {
        return $this->_params ?: ($this->_params = new Params);
    }

    /**
     * setParams
     *
     * @param A\Mvc\Request\Params $params
     * @return void
     */
    public function setParams(Params $params)
    {
        $this->_params = $params;
    }

    /**
     * getRouter
     *
     * @return A\Mvc\Request\Router
     */
    public function getRouter()
    {
        return $this->_router ?: ($this->_router = new Router);
    }

    /**
     * setRouter
     *
     * @param A\Mvc\Request\Router $router
     * @return void
     */
    public function setRouter(Router $router)
    {
        $this->_router = $router;
    }

    /**
     * getSource
     *
     * @return A\Mvc\Request\Source
     */
    public function getSource()
    {
        return $this->_source ?: ($this->_source = new Source);
    }

    /**
     * setSource
     *
     * @param A\Mvc\Request\Source $source
     * @return void
     */
    public function setSource(Source $source)
    {
        $this->_source = $source;
    }
}
// End of file : Request.php
