<?php

namespace Pok\WebArchiveDotOrg;

use Zend\Http\Client as HttpClient;

/**
 * @author Florent Denis <dflorent.pokap@gmail.com>
 */
class Client
{
    /**
     * @var \Zend\Http\Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->client = new HttpClient($request->getUri());
    }

    /**
     * @return Response
     */
    public function send()
    {
        return new Response($this->client->send());
    }
}
