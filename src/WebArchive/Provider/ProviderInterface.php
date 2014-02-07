<?php

namespace WebArchive\Provider;

use Zend\Http\Response;

interface ProviderInterface
{
    public function createUrlRequest($url);

    public function generateSnapshots(Response $response);
}
