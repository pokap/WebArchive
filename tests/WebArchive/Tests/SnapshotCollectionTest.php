<?php

namespace WebArchive\Tests;

use WebArchive\SnapshotCollection;

class SnapshotCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPeriod()
    {
        $sc = new SnapshotCollection(new \DateTime('12-12-2013'), new \DateTime('20-12-2013'));

        $this->assertInstanceOf('DatePeriod', $sc->getPeriod());

        $day = 0;
        foreach ($sc->getPeriod() as $date) {
            $day++;
        }

        // count days between start and end date included
        $this->assertEquals(9, $day);
    }
}
