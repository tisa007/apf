<?php
/** 
 *           File:  Controller.php
 *           Path:  ./A
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-06-18
 */
namespace A;
use A\Mvc\Context;
use A\Mvc\Control;
use A\Mvc\Process;
use A\Mvc\Subject;

class Controller implements Process
{
    use Subject;

    /**
     * _context
     *
     * @var A\Mvc\Context
     */
    protected $_context;

    /**
     * __construct
     *
     * @param A\Mvc\Context $context
     * @return void
     */
    public function __construct(Context $context)
    {
        $this->_context = $context;
    }

    /**
     * __invoke
     *
     * @return A\Mvc\Context
     */
    public function __invoke()
    {
        return $this->process();
    }

    /**
     * __get
     *
     * @param string $key
     * @return mixed
     */
    public function &__get($key)
    {
        $val = $this->factory($key);

        static $set;
        $set === null AND $set = function($obj, $key, $val){$obj->$key = $val;};
        $set($this, $key, $val);

        return $this->$key;
    }

    /**
     * _prepare
     *
     * @return void
     */
    protected function _prepare()
    {
    }

    /**
     * _execute
     *
     * @return void
     */
    protected function _execute()
    {
    }

    /**
     * _achieve
     *
     * @return void
     */
    protected function _achieve()
    {
    }

    /**
     * process
     *
     * @return A\Mvc\Context
     */
    public function process()
    {
        $this->_prepare();
        $this->_execute();
        $this->_achieve();

        return $this->_context;
    }

    /**
     * context
     *
     * @param string $name
     * @return mixed
     */
    public function context($name)
    {
        return method_exists($this->_context, $name = 'get' . ucfirst($name)) ? $this->_context->$name() : null;
    }

    /**
     * factory
     *
     * @param mixed $name
     * @param mixed $args
     * @return mixed
     */
    public function factory($name, $args = [])
    {
        $name = implode('\\', array_map('ucfirst', explode('/', __CLASS__ . '/Control/' . $name)));
        if (class_exists($name))
        {
            $ctrl = new $name;
            if ($ctrl instanceof Control)
            {
                $ctrl = $ctrl->control($this, $args);
            }

            return $ctrl;
        }
    }

    /**
     * destroy
     *
     * @throw A\Mvc\Process\Destroy
     * @return void
     */
    public function destroy()
    {
        throw new Process\Destroy;
    }

    /**
     * forward
     *
     * @throw A\Mvc\Process\Forward
     * @param mixed $target
     * @return void
     */
    public function forward($target)
    {
        throw new Process\Forward(new Context\Target($target));
    }
}
// End of file : Controller.php
