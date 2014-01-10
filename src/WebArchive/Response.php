<?php

namespace WebArchive;

use Zend\Http\Response as HttpResponse;
use Zend\Uri\Http;

/**
 * @author Florent Denis <dflorent.pokap@gmail.com>
 */
class Response extends BaseResponse
{
    /**
     * @var Http
     */
    protected $uri;

    /**
     * Constructor.
     *
     * @param HttpResponse $response
     * @param Http         $uri
     */
    public function __construct(HttpResponse $response, Http $uri)
    {
        parent::__construct($response);

        $this->uri = $uri;
    }

    /**
     * Get uri (from the request).
     *
     * @return Http
     */
    public function getUri()
    {
        return $this->uri;
    }
}
