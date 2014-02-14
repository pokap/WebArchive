<?php

namespace WebArchive;

use Zend\Http\Client as HttpClient;

use WebArchive\Provider\ProviderInterface;

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
     * @var ProviderInterface
     */
    protected $provider;

    /**
     * @var \Zend\Http\Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param Request           $request
     * @param ProviderInterface $provider
     */
    public function __construct(Request $request, ProviderInterface $provider)
    {
        $this->request  = $request;
        $this->provider = $provider;

        $this->client = new HttpClient($provider->createUrlRequest($request->getUrl()), $request->getOptions());
    }

    /**
     * Send HTTP request and returns the collection of snapshots generated.
     *
     * @return SnapshotCollection
     *
     * @throws \Zend\Http\Exception\RuntimeException
     * @throws \Zend\Http\Client\Exception\RuntimeException
     */
    public function get()
    {
        return $this->provider->generateSnapshots($this->client->send(), $this->request->getUrl());
    }
}
