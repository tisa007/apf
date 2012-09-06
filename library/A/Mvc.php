<?php
/** 
 *           File:  Mvc.php
 *           Path:  ./A
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-06-14
 */
namespace A;
use A\Mvc\Context;
use A\Mvc\Locator;
use A\Mvc\Message;
use A\Mvc\Process;
use A\Mvc\Setting;
use A\Mvc\Storage;

class Mvc implements Process
{
    /**
     * _context
     *
     * @var A\Mvc\Context
     */
    protected $_context;

    /**
     * _locator
     *
     * @var A\Mvc\Locator
     */
    protected $_locator;

    /**
     * _setting
     *
     * @var A\Mvc\Setting
     */
    protected $_setting;

    /**
     * _storage
     *
     * @var A\Mvc\Storage
     */
    protected $_storage;

    /**
     * setContext
     *
     * @param A\Mvc\Context $context
     * @return void
     */
    public function setContext(Context $context)
    {
        $this->_context = $context;
    }

    /**
     * getContext
     *
     * @return A\Mvc\Context
     */
    public function getContext()
    {
        return $this->_context ?: ($this->_context = new Context);
    }

    /**
     * setLocator
     *
     * @param A\Mvc\Locator $locator
     * @return void
     */
    public function setLocator(Locator $locator)
    {
        $this->_locator = $locator;
    }

    /**
     * getLocator
     *
     * @return A\Mvc\Locator
     */
    public function getLocator()
    {
        return $this->_locator ?: ($this->_locator = new Locator);
    }

    /**
     * setSetting
     *
     * @param A\Mvc\Setting $setting
     * @return void
     */
    public function setSetting(Setting $setting)
    {
        $this->_setting = $setting;
    }

    /**
     * getSetting
     *
     * @return A\Mvc\Setting
     */
    public function getSetting()
    {
        return $this->_setting ?: ($this->_setting = new Setting);
    }

    /**
     * setStorage
     *
     * @param A\Mvc\Storage $storage
     * @return void
     */
    public function setStorage(Storage $storage)
    {
        $this->_storage = $storage;
    }

    /**
     * getStorage
     *
     * @return A\Mvc\Storage
     */
    public function getStorage()
    {
        return $this->_storage ?: ($this->_storage = new Storage);
    }

    /**
     * process
     *
     * @return A\Mvc\Respond
     */
    public function process()
    {
        try
        {
            return $this->getContext()->invoke(['process' => function(Mvc $sender) {
                return call_user_func($sender->getLocator()->locate($sender->getContext()));
            }], [], $this);

            destory: return $this->getContext()->invoke(['destory' => function(Mvc $sender) {
                return $sender->getContext();
            }], [], $this);

            forward: return $this->getContext()->invoke(['forward' => function(Mvc $sender, $target) {
                $params = $sender->getContext()->getParams();
                foreach ($target as $key => $val)
                {
                    $params[$key] = $val;
                }

                return $sender->process();
            }], $forward->getTarget(), $this);
        }
        catch (Process\Destroy $destroy)
        {
            goto destory;
        }
        catch (Process\Forward $forward)
        {
            goto forward;
        }
    }

    /**
     * getInstance
     *
     * @return A\Mvc
     */
    public static function getInstance()
    {
        static $mvc;
        $mvc === null AND $mvc = new static;

        return $mvc;
    }
}
// End of file : Mvc.php
