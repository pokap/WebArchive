<?php

namespace WebArchive\Tests\Mocks;

use Symfony\Component\DomCrawler\Crawler;

use WebArchive\ResponseList;

class ResponseListMock extends ResponseList
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
