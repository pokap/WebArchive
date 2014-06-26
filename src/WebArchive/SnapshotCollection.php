<?php

namespace WebArchive;

class SnapshotCollection
{
    protected $period;
    protected $snapshots;

    public function __construct(\DateTime $begin, \DateTime $end)
    {
        // the end date is exclude in date period
        $end = $end->modify('+1 day');

        $this->period = new \DatePeriod($begin, new \DateInterval('P1D'), $end);

        $this->snapshots = new \ArrayObject();
    }

    /**
     * @return \DatePeriod
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @return \ArrayObject
     */
    public function getSnapshots()
    {
        return $this->snapshots;
    }
}
