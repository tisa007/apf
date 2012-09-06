<?php
/** 
 *           File:  Source.php
 *           Path:  ./A/Mvc/Request
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2012-05-28
 */
namespace A\Mvc\Request;

class Source
{
    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getServer('REQUEST_URI') ?: implode(' ', $this->getServer('argv') ?: []);
    }

    /**
     * getServer
     *
     * @param string $key
     * @return mixed
     */
    public function getServer($key)
    {
        return isset($_SERVER[$key]) ? $_SERVER[$key] : null;
    }

    /**
     * getCookie
     *
     * @param string $key
     * @return string
     */
    public function getCookie($key)
    {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

    /**
     * getHeader
     * Return the value of the given HTTP header. Pass the header name as the
     * plain, HTTP-specified header name. Ex.: Ask for 'Accept' to get the
     * Accept header, 'Accept-Encoding' to get the Accept-Encoding header.
     *
     * @param string $key
     * @return string
     */
    public function getHeader($key)
    {
        $skey = 'HTTP_' . strtoupper(str_replace('-', '_', $key));
        if (isset($_SERVER[$skey]))
        {
            return $_SERVER[$skey];
        }

        if (function_exists('apache_request_headers'))
        {
            $headers = apache_request_headers();
            if (isset($headers[$key]))
            {
                return $headers[$key];
            }
        }
    }

    /**
     * getMethod
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->getServer('REQUEST_METHOD');
    }

    /**
     * getScheme
     *
     * @return string
     */
    public function getScheme()
    {
        return $this->getServer('HTTPS') == 'on' ? 'https' : 'http';
    }

    /**
     * getClientIp
     *
     * @return string
     */
    public function getClientIp()
    {
        if ($this->getServer('HTTP_CLIENT_IP') != null)
        {
            return $this->getServer('HTTP_CLIENT_IP');
        }

        if ($this->getServer('HTTP_X_FORWARDED_FOR') != null)
        {
            return $this->getServer('HTTP_X_FORWARDED_FOR');
        }

        return $this->getServer('REMOTE_ADDR');
    }

    /**
     * getQuery
     *
     * @param mixed $key
     * @return mixed
     */
    public function getQuery($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    /**
     * getInput
     *
     * @param mixed $key
     * @return mixed
     */
    public function getInput($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }
}
// End of file : Source.php
