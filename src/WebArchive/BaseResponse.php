<?php

namespace WebArchive;

use Zend\Http\Response as HttpResponse;

/**
 * @author Florent Denis <dflorent.pokap@gmail.com>
 */
abstract class BaseResponse
{
    /**
     * @var \Zend\Http\Response
     */
    protected $response;

    /**
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    protected $crawler;

    /**
     * Constructor.
     *
     * @param HttpResponse $response
     */
    public function __construct(HttpResponse $response)
    {
        $this->response = $response;
    }

    /**
     * Do we have a normal, OK response?
     *
     * @return bool
     */
    public function isOk()
    {
        return $this->response->isOk();
    }

    /**
     * Does the status code indicate the resource is not found?
     *
     * @return bool
     */
    public function isNotFound()
    {
        return $this->response->isNotFound();
    }

    /**
     * Does the status code reflect a server error?
     *
     * @return bool
     */
    public function isServerError()
    {
        return $this->response->isServerError();
    }
}
