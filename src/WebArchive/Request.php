<?php

namespace WebArchive;

/**
 * @author Florent Denis <dflorent.pokap@gmail.com>
 */
class Request
{
    /**
     * @var string
     */
    protected $uri;

    /**
     * @var boolean
     */
    protected $isList;

    /**
     * Constructor.
     *
     * @param string                 $url
     * @param null|integer|\DateTime $date (optional)
     */
    public function __construct($url, $date = null)
    {
        $this->isList = true;

        if ($date instanceof \DateTime) {
            $this->isList = false;
            $path = sprintf('/%s/', $date->format('YmdHis'));
        } elseif ($date) {
            $path = sprintf('/%d1201000000*/', $date);
        } else {
            $path = '/*/';
        }

        $this->uri = 'http://web.archive.org/web' . $path . $url;
    }

    /**
     * Request for a list of archives.
     *
     * @return boolean
     */
    public function isList()
    {
        return $this->isList;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }
}
