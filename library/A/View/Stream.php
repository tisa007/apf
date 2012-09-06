<?php
/**
 *           File:  Stream.php
 *           Path:  ./A/View
 *         Author:  Alvan
 *       Modifier:  Alvan
 *       Modified:  2011-08-31
 */
namespace A\View;

/**
 * Stream wrapper to convert markup of mostly-PHP templates into PHP prior to include().
 *
 * Based in large part on the example at
 * http://www.php.net/manual/en/function.stream-wrapper-register.php
 *
 * As well as the example provided at:
 *     http://mikenaberezny.com/2006/02/19/symphony-templates-ruby-erb/
 * written by
 *     Mike Naberezny (@link http://mikenaberezny.com)
 *     Paul M. Jones  (@link http://paul-m-jones.com)
 */
class Stream
{
    /**
     * _cpos
     * Current stream position.
     *
     * @var int
     */
    protected $_cpos = 0;

    /**
     * _data
     * Data for streaming.
     *
     * @var string
     */
    protected $_data;

    /**
     * _stat
     * Stream stats.
     *
     * @var array
     */
    protected $_stat;

    /**
     * _pr3o
     * The wrapper name to be registered
     *
     * @var string
     */
    protected $_pr3o = 'a.view//';

    /**
     * Opens the script file and converts markup.
     */
    public function stream_open($path, $mode, $options, &$opened_path)
    {
        $path        = str_replace($this->_pr3o, '', $path);
        $this->_data = file_get_contents($path);

        /**
         * If reading the file failed, update our local stat store
         * to reflect the real stat of the file, then return on failure
         */
        if ($this->_data === false)
        {
            $this->_stat = stat($path);
            return false;
        }

        /**
         * file_get_contents() won't update PHP's stat cache, so we grab a stat
         * of the file to prevent additional reads should the script be
         * requested again, which will make include() happy.
         */
        $this->_stat = stat($path);

        /**
         * Convert <?= ?> to long-form <?php echo ?> and <? ?> to <?php ?>
         */
        $this->_data = preg_replace('/\<\?\=/',          '<?php echo ', $this->_data);
        $this->_data = preg_replace('/<\?(?!xml|php)/s', '<?php ',      $this->_data);

        return true;
    }

    /**
     * Reads from the stream.
     */
    public function stream_read($count)
    {
        $ret = substr($this->_data, $this->_cpos, $count);
        $this->_cpos += strlen($ret);
        return $ret;
    }

    /**
     * Seek to a specific point in the stream.
     */
    public function stream_seek($offset, $whence)
    {
        switch ($whence)
        {
            case SEEK_SET:
                if ($offset < strlen($this->_data) && $offset >= 0)
                {
                    $this->_cpos = $offset;
                    return true;
                }
                else
                {
                    return false;
                }
                break;

            case SEEK_CUR:
                if ($offset >= 0)
                {
                    $this->_cpos += $offset;
                    return true;
                }
                else
                {
                    return false;
                }
                break;

            case SEEK_END:
                if (strlen($this->_data) + $offset >= 0)
                {
                    $this->_cpos = strlen($this->_data) + $offset;
                    return true;
                }
                else
                {
                    return false;
                }
                break;

            default:
                return false;
        }
    }

    /**
     * Tells the current position in the stream.
     */
    public function stream_tell()
    {
        return $this->_cpos;
    }

    /**
     * Stream statistics.
     */
    public function stream_stat()
    {
        return $this->_stat;
    }

    /**
     * Included so that __FILE__ returns the appropriate info
     *
     * @return array
     */
    public function url_stat()
    {
        return $this->_stat;
    }

    /**
     * Tells if we are at the end of the stream.
     */
    public function stream_eof()
    {
        return $this->_cpos >= strlen($this->_data);
    }
}
// End of file : Stream.php
