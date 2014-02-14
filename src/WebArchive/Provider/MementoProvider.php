<?php

namespace WebArchive\Provider;

use Zend\Http\Response;

use WebArchive\Snapshot;
use WebArchive\SnapshotCollection;

class MementoProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function createUrlRequest($url)
    {
        return sprintf('http://web.archive.org/web/timemap/link/%s', $url);
    }

    /**
     * {@inheritdoc}
     */
    public function generateSnapshots(Response $response, $url)
    {
        $dates = $this->getMetaData($response);

        $snapshots = new SnapshotCollection(current($dates), end($dates));
        $snapshots->getSnapshots()->exchangeArray($dates);

        return $snapshots;
    }

    /**
     * List of links given by response http body.
     *
     * @param Response $response
     *
     * @return Snapshot[]
     */
    protected function getMetaData(Response $response)
    {
        $links = array();

        foreach (explode($response->getBody(), ",") as $link) {
            $data = explode(trim($link), ';');

            if (false === strpos($data[1], 'memento') || !isset($data[2])) {
                continue;
            }

            $date = substr(trim($data[2]), 10, -5);

            $links[] = new Snapshot(\DateTime::createFromFormat('D, d M Y H:i:s', $date), substr($data[0], 1, -1));
        }

        return $links;
    }
}
