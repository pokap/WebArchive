<?php

namespace Pok\WebArchiveDotOrg;

use Zend\Http\Client as HttpClient;

/**
 * @author Florent Denis <dflorent.pokap@gmail.com>
 */
class Client
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var \Zend\Http\Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param Request            $request
     * @param array|\Traversable $options
     */
    public function __construct(Request $request, $options = null)
    {
        $this->request = $request;
        $this->client  = new HttpClient($request->getUri(), $options);
    }

    /**
     * Send HTTP request.
     *
     * @return BaseResponse
     *
     * @throws \Zend\Http\Exception\RuntimeException
     * @throws \Zend\Http\Client\Exception\RuntimeException
     */
    public function send()
    {
        $response = $this->client->send();

        if ($this->request->isList()) {
            return new ResponseList($response);
        } else {
            return new Response($response, $this->client->getUri());
        }
    }
}
