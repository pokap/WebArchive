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
     * @var array|\Traversable
     */
    protected $options;

    /**
     * Constructor.
     *
     * @param string             $url
     * @param array|\Traversable $options
     */
    public function __construct($url, $options = null)
    {
        $this->url     = $url;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array|\Traversable
     */
    public function getOptions()
    {
        return $this->options;
    }
}
