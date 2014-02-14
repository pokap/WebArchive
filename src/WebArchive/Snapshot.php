<?php

namespace WebArchive;

class Snapshot
{
    protected $date;
    protected $url;

    /**
     * Constructor.
     *
     * @param \DateTime $date
     * @param string    $url
     */
    public function __construct(\DateTime $date, $url)
    {
        $this->date = $date;
        $this->url  = $url;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
