<?php

namespace WebArchive\Provider;

use Symfony\Component\DomCrawler\Crawler;

use Zend\Http\Response;

class WayBackProvider implements ProviderInterface
{
    protected $year;
    protected $crawler;

    public function __construct($year = '*')
    {
        $this->year = $year;
    }

    /**
     * {@inheritdoc}
     */
    public function createUrlRequest($url)
    {
        return sprintf('http://web.archive.org/web/%s/%s', $this->year, $url);
    }

    public function generateSnapshots(Response $response)
    {
        return $this->getDates($response, '.pop ul a');
    }

    /**
     * @param Response $response
     * @param $selector
     *
     * @return \DateTime[]
     */
    protected function getDates(Response $response, $selector)
    {
        return $this->getCrawler($response)->filter($selector)->each(function ($node, $i) {
            /** @var Crawler $node */
            return \DateTime::createFromFormat('YmdHis', substr($node->attr('href'), 5, 14));
        });
    }

    /**
     * @return Crawler
     */
    protected function getCrawler(Response $response)
    {
        if (null === $this->crawler) {
            $this->crawler = new Crawler();
            $this->crawler->addContent($response->getBody());

            $this->crawler = $this->crawler->filter('#wbCalendar .date');
        }

        return $this->crawler;
    }
}
