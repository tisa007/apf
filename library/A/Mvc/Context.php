<?php
/** 
 *           File:  Context.php
 *           Path:  ./A/Mvc
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-07-31
 */
namespace A\Mvc;
use A\Mvc\Context\Output;
use A\Mvc\Request\Params;
use A\Mvc\Request\Router;
use A\Mvc\Request\Source;

class Context implements Respond
{
    use Subject;

    /**
     * _output
     *
     * @var A\Mvc\Context\Output
     */
    protected $_output;

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
     * @param A\Mvc\Request\Params $params
     * @return void
     */
    public function __construct(Source $source = null, Router $router = null, Params $params = null)
    {
        $this->_source = $source;
        $this->_router = $router;
        $this->_params = $params;
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

    /**
     * getOutput
     *
     * @return A\Mvc\Context\Output
     */
    public function getOutput()
    {
        return $this->_output ?: ($this->_output = new Output);
    }

    /**
     * setOutput
     *
     * @param A\Mvc\Context\Output $output
     * @return void
     */
    public function setOutput(Output $output)
    {
        $this->_output = $output;
    }

    /**
     * respond
     *
     * @return void
     */
    public function respond()
    {
        $this->notify('flush');

        $this->invoke(['respond' => function(Context $sender) {
            $sender->getOutput()->respond();
        }]);

        $this->notify('clear');
    }
}
// End of file : Context.php
