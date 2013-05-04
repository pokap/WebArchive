<?php

namespace Pok\WebArchiveDotOrg\Tests\Mocks;

use Pok\WebArchiveDotOrg\Response;
use Symfony\Component\DomCrawler\Crawler;

class ResponseMock extends Response
{
    /**
     * Constructor.
     *
     * @param string $file
     */
    public function __construct($file)
    {
        $this->response = $file;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return file_exists($this->response);
    }

    /**
     * {@inheritdoc}
     */
    protected function getCrawler()
    {
        if (null === $this->crawler) {
            $this->crawler = new Crawler();
            $this->crawler->addContent(file_get_contents($this->response));

            $this->crawler = $this->crawler->filter('#wbCalendar .date');
        }

        return $this->crawler;
    }
}