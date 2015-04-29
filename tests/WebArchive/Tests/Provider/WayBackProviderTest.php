<?php

namespace WebArchive\Tests\Provider;

use Zend\Http\Client;
use Zend\Http\Client\Adapter\Test as TestAdapter;
use Zend\Http\Response;

use WebArchive\Provider\WayBackProvider;

class WayBackProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDate2013()
    {
        $collection = $this->generateSnapshots(2013);

        $this->assertCount(1144, $collection->getSnapshots());
    }

    public function testGetDate1997()
    {
        $collection = $this->generateSnapshots(1997);

        $this->assertCount(3, $collection->getSnapshots());
    }

    /**
     * @param int $year
     *
     * @return \WebArchive\SnapshotCollection
     */
    private function generateSnapshots($year)
    {
        $uri = 'http://archive.org/';
        $provider = new WayBackProvider($year);

        $client = new Client($provider->createUrlRequest($uri));

        $response = new Response();
        $response->setContent(implode(gzfile(__DIR__.'/fixtures/archive.org-'.$year.'.html.gz')));

        $adapter = new TestAdapter();
        $adapter->setResponse($response);

        $client->setAdapter($adapter);

        return $provider->generateSnapshots($client->send(), $uri);
    }
}
