<?php

namespace WebArchive\Tests;

use Zend\Http\Client\Adapter\Test as TestAdapter;
use Zend\Http\Response;

use WebArchive\Client;
use WebArchive\Request;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function test__construct()
    {
        $mock = $this->getMock('WebArchive\\Provider\\ProviderInterface');
        $mock->expects($this->once())
            ->method('createUrlRequest')
            ->will($this->returnCallback(function ($url) { return $url; }));

        $request = new Request('http://test.test/');
        $client = new Client($request, $mock);

        $this->assertInstanceOf('Zend\\Http\\Client', $client->getClient());
        $this->assertEquals($request->getUrl(), (string) $client->getClient()->getUri());
    }

    public function testRetrieve()
    {
        $mock = $this->getMock('WebArchive\\Provider\\ProviderInterface');
        $mock->expects($this->once())
            ->method('generateSnapshots')
            ->will($this->returnValue(true));

        $client = new Client(new Request(null), $mock);

        $adapter = new TestAdapter();
        $adapter->setResponse(new Response());

        $client->getClient()->setAdapter($adapter);

        $this->assertTrue($client->retrieve());
    }
}
