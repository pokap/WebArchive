<?php

namespace Pok\WebArchiveDotOrg\Tests\Mocks;

use Pok\WebArchiveDotOrg\Request;

class ClientMock
{
    /**
     * @var string
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->client = sprintf('%s/../fixtures/%s.html', __DIR__, $request->getUri());
    }

    /**
     * @return ResponseMock
     */
    public function send()
    {
        return new ResponseMock($this->client);
    }
}