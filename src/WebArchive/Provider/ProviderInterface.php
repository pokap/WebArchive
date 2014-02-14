<?php

namespace WebArchive\Provider;

use Zend\Http\Response;

interface ProviderInterface
{
    /**
     * @param $url
     *
     * @return string
     */
    public function createUrlRequest($url);

    /**
     * @param Response $response
     * @param string   $url      Deprecated
     *
     * @return \WebArchive\SnapshotCollection
     */
    public function generateSnapshots(Response $response, $url);
}
