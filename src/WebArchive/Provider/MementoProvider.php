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

        if (!$dates) {
            return null;
        }

        $snapshots = new SnapshotCollection(current($dates)->getDate(), end($dates)->getDate());
        $snapshots->getSnapshots()->exchangeArray($dates);

        return $snapshots;
    }

    /**
     * List of links given by response http body.
     * Content type is application/link-format.
     *
     * @param Response $response
     *
     * @return Snapshot[]
     */
    protected function getMetaData(Response $response)
    {
        $links = array();

        foreach (explode("\n", $response->getBody()) as $link) {
            $elements = $this->decodeLink($link);

            if (!isset($elements['rel'], $elements['datetime'])) {
                continue;
            }

            $links[] = new Snapshot(\DateTime::createFromFormat('D, d M Y H:i:s \G\M\T', $elements['datetime']), substr($elements['link'], 1, -1));
        }

        return $links;
    }

    /**
     * Returns array association which illustrates a description link.
     *
     * @param string $link
     *
     * @return array
     */
    private function decodeLink($link)
    {
        $elements = array();
        foreach (explode(';', trim($link, ",")) as $key => $el) {
            if (0 === $key) {
                $elements['link'] = trim($el, " \n\t\0<>");

                continue;
            }

            $data = explode('=', $el, 2);

            $elements[trim($data[0])] = trim($data[1], " \n\t\0\"");
        }

        return $elements;
    }
}
