<?php
/** 
 *           File:  Resource.php
 *           Path:  ./A/Acl
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-04-23
 */
namespace A\Acl;

class Resource
{
    /**
     * _pathname
     *
     * @var string
     */
    protected $_pathname;

    /**
     * _segments
     *
     * @var array
     */
    protected $_segments;

    /**
     * __construct
     *
     * @param mixed $pathname
     * @param array $segments
     * @return void
     */
    public function __construct($pathname, array $segments = [])
    {
        $this->setPathname($pathname);
        $this->setSegments($segments);
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getPathname();
    }

    /**
     * getPathname
     *
     * @return string
     */
    public function getPathname()
    {
        return $this->_pathname;
    }

    /**
     * setPathname
     *
     * @param mixed $pathname
     * @return void
     */
    public function setPathname($pathname)
    {
        $this->_pathname = (string)$pathname;
    }

    /**
     * getSegments
     *
     * @return array
     */
    public function getSegments()
    {
        return $this->_segments;
    }

    /**
     * setSegments
     *
     * @param array $segments
     * @return void
     */
    public function setSegments(array $segments)
    {
        $this->_segments = $segments;
    }
}
// End of file : Resource.php
