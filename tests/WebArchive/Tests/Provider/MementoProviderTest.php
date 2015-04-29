<?php

namespace WebArchive\Tests\Provider;

use Zend\Http\Client;
use Zend\Http\Client\Adapter\Test as TestAdapter;
use Zend\Http\Response;

use WebArchive\Provider\MementoProvider;

class MementoProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateSnapshots()
    {
        $collection = $this->generateSnapshots();

        $this->assertCount(1, $collection->getSnapshots());
    }

    /**
     * @return \WebArchive\SnapshotCollection
     */
    private function generateSnapshots()
    {
        $uri = 'http://pokap.io/';
        $provider = new MementoProvider();

        $client = new Client($provider->createUrlRequest($uri));

        $response = new Response();
        $response->setContent(implode(gzfile(__DIR__.'/fixtures/pokap.io-memento.gz')));

        $adapter = new TestAdapter();
        $adapter->setResponse($response);

        $client->setAdapter($adapter);

        return $provider->generateSnapshots($client->send(), $uri);
    }
}
