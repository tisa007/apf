<?php
/** 
 *           File:  Subject.php
 *           Path:  ./A/Mvc
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-07-06
 */
namespace A\Mvc;

trait Subject
{
    /**
     * _vector
     *
     * @var array
     */
    protected $_vector = [];

    /**
     * _actors
     *
     * @var array
     */
    protected $_actors = [];

    /**
     * attach
     *
     * @param mixed $signal
     * @param mixed $object
     * @param mixed $weight
     * @return void
     */
    public function attach($signal, $object, $weight = 1)
    {
        if (!isset($this->_vector[$signal]))
        {
            $this->_vector[$signal] = [];
        }

        $this->_vector[$signal][] = [$object, $weight];
    }

    /**
     * detach
     *
     * @param mixed $signal
     * @param mixed $object
     * @return void
     */
    public function detach($signal = null, $object = null)
    {
        $argc = func_num_args();
        if ($argc < 1)
        {
            $this->_vector = [];
        }
        else if ($argc < 2)
        {
            unset($this->_vector[$signal]);
        }
        else if (isset($this->_vector[$signal]))
        {
            foreach ($this->_vector as $key => &$val)
            {
                if ($val[0] === $object)
                {
                    unset($this->_vector[$signal][$key]);
                }
            }
        }
    }

    /**
     * notify
     *
     * @param mixed $signal
     * @param mixed $params
     * @param mixed $sender
     * @param mixed $result
     * @return void
     */
    public function notify($signal, $params = [], $sender = null, $result = null)
    {
        if (isset($this->_vector[$signal]))
        {
            $vector = new \SplPriorityQueue;
            $vector->setExtractFlags(\SplPriorityQueue::EXTR_DATA);
            foreach ($this->_vector[$signal] as $action)
            {
                $vector->insert($action[0], $action[1]);
            }

            $sender = func_num_args() > 2 ? $sender : $this;
            while (!$vector->isEmpty() && !call_user_func($vector->current(), $sender, $params, $signal, $result))
            {
                $vector->next();
            }
        }
    }

    /**
     * handle
     *
     * @param mixed $signal
     * @param mixed $object
     * @return void
     */
    public function handle($signal, $object)
    {
        if (!isset($this->_actors[$signal]))
        {
            $this->_actors[$signal] = [];
        }

        $this->_actors[$signal][] = $object;
    }

    /**
     * unbind
     *
     * @param mixed $signal
     * @param mixed $object
     * @return void
     */
    public function unbind($signal = null, $object = null)
    {
        $argc = func_num_args();
        if ($argc < 1)
        {
            $this->_actors = [];
        }
        else if ($argc < 2)
        {
            unset($this->_actors[$signal]);
        }
        else if (isset($this->_actors[$signal]))
        {
            foreach ($this->_actors as $key => &$val)
            {
                if ($val === $object)
                {
                    unset($this->_actors[$signal][$key]);
                }
            }
        }
    }

    /**
     * invoke
     *
     * @param array $method
     * @param mixed $params
     * @param mixed $sender
     * @return mixed
     */
    public function invoke(array $method, $params = [], $sender = null)
    {
        $signal = key($method);
        $actors = isset($this->_actors[$signal]) ? $this->_actors[$signal] : [];
        array_unshift($actors, current($method));

        $sender = func_num_args() > 2 ? $sender : $this;

        $this->notify('!' . $signal, $params, $sender);
        $this->notify('^' . $signal, $params, $sender);
        $result = new Control\Result((new Control\Actors($signal, $actors))->invoke($sender, $params));
        $this->notify($signal . '$', $params, $sender, $result);
        $this->notify('!' . $signal, $params, $sender, $result);

        return $result->getResult();
    }
}
// End of file : Subject.php
