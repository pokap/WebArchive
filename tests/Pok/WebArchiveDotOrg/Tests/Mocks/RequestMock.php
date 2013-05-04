<?php

namespace Pok\WebArchiveDotOrg\Tests\Mocks;

use Pok\WebArchiveDotOrg\Request;

class RequestMock extends Request
{
    /**
     * {@inheritdoc}
     */
    public function __construct($url, $year = null)
    {
        switch ($url) {
            case 'http://archive.org/':
                $path = 'archive.org';
                break;

            default:
                throw new \InvalidArgumentException(sprintf('Url "%s" does not match any path.', $url));
        }

        if (null === $year) {
            $this->uri = $path;
        } else {
            $this->uri = $path . '-' . $year . '1201000000';
        }
    }
}
