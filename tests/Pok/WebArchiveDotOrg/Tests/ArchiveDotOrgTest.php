<?php

namespace Pok\WebArchiveDotOrg\Tests;

use Pok\WebArchiveDotOrg\Tests\Mocks\ClientMock;
use Pok\WebArchiveDotOrg\Tests\Mocks\RequestMock;
use Pok\WebArchiveDotOrg\Tests\Mocks\ResponseMock;

class ArchiveDotOrgTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDate2013()
    {
        $response = $this->generateResponse(2013);

        $this->assertEquals(70, count($response->getDateArchives()));
        $this->assertEquals(124, count($response->getDateSnapshots()));
    }

    public function testGetDate1997()
    {
        $response = $this->generateResponse(1997);

        $this->assertEquals(3, count($response->getDateArchives()));
        $this->assertEquals(3, count($response->getDateSnapshots()));
    }

    public function generateResponse($year)
    {
        $client = new ClientMock(new RequestMock('http://archive.org/', $year));

        return $client->send();
    }
}
