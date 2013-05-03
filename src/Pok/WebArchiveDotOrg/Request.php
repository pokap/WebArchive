<?php

namespace Pok\WebArchiveDotOrg;

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
     * Constructor.
     *
     * @param string       $url
     * @param null|integer $year
     */
    public function __construct($url, $year = null)
    {
        if ($year) {
            $path = '/' . $year . '1201000000*/';
        } else {
            $path = '/*/';
        }

        $this->uri = 'http://web.archive.org/web' . $path . $url;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }
}
