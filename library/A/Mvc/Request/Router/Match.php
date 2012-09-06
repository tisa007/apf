<?php
/** 
 *           File:  Match.php
 *           Path:  ./A/Mvc/Request/Router
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-07-10
 */
namespace A\Mvc\Request\Router;
use A\Mvc\Request\Params;
use A\Mvc\Request\Source;

class Match implements Route
{
    /**
     * _matches
     *
     * @var array
     */
    protected $_matches;

    /**
     * _pattern
     *
     * @var string
     */
    protected $_pattern;

    /**
     * _subject
     *
     * @var string
     */
    protected $_subject;

    /**
     * __construct
     *
     * @param string $pattern
     * @param string $subject
     * @param array  $matches
     * @return void
     */
    public function __construct($pattern, $subject = null, array $matches = [])
    {
        $this->_pattern = $pattern;
        $this->_subject = $subject;
        $this->_matches = $matches;
    }

    /**
     * route
     *
     * @param A\Mvc\Request\Source $source
     * @param A\Mvc\Request\Params $params
     * @return void
     */
    public function route(Source $source, Params $params)
    {
        if ($this->_subject == '')
        {
            $subject = $source;
        }
        else if (method_exists($source, $method = 'get' . ucfirst($this->_subject)))
        {
            $subject = $source->$method();
        }
        else
        {
            return;
        }

        $matches = [];
        if (static::match($this->_pattern, $subject, $matches))
        {
            $matches += $this->_matches;
            foreach ($matches as $key => $val)
            {
                $params[$key] = $val;
            }
        }
    }

    /**
     * match
     *
     * @param mixed $pattern
     * @param mixed $subject
     * @param array $matches
     * @return bool
     */
    public static function match($pattern, $subject, array &$matches = null)
    {
        if (preg_match((string)$pattern, (string)$subject, $matches))
        {
            foreach (array_keys($matches) as $key)
            {
                if (is_int($key))
                {
                    unset($matches[$key]);
                }
            }

            return true;
        }

        return false;
    }
}
// End of file : Match.php
