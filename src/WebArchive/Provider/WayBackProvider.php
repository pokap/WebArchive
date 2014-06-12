<?php

namespace WebArchive\Provider;

use Symfony\Component\DomCrawler\Crawler;

use WebArchive\Snapshot;
use WebArchive\SnapshotCollection;

use Zend\Http\Response;

class WayBackProvider implements ProviderInterface
{
    const BASE_URL = 'http://web.archive.org/web/';

    protected $year;
    protected $crawler;
    protected $currentUrl;

    /**
     * Constructor.
     *
     * @param string $year Year 2014 or * for all (optional)
     *
     * @throws \InvalidArgumentException When year value is invalid
     */
    public function __construct($year = '*')
    {
        if ($year !== '*' && (strlen($year) !== 4 || !ctype_digit($year))) {
            throw new \InvalidArgumentException(sprintf('Year value must be like 2014 or "*", "%s" given.', $year));
        }

        if ($year === '*') {
            $year = idate('Y');
        }

        $this->year = $year;
    }

    /**
     * {@inheritdoc}
     */
    public function createUrlRequest($url)
    {
        return self::BASE_URL . sprintf('%d1201000000*/%s', $this->year, $url);
    }

    /**
     * {@inheritdoc}
     */
    public function generateSnapshots(Response $response, $url)
    {
        $start = \DateTime::createFromFormat('U', mktime(0, 0, 0, 1, 1, $this->year));
        $snapshots = new SnapshotCollection($start, $start->add(new \DateInterval('P1Y')));

        foreach ($this->getDates($response) as $date) {
            $snapshot = new Snapshot($date, self::BASE_URL . sprintf('%s/%s', $date->format('YmdHis'), $url));

            $snapshots->getSnapshots()->append($snapshot);
        }

        return $snapshots;
    }

    /**
     * Returns all snapshots captured by the crawler.
     *
     * @param Response $response
     *
     * @return \DateTime[]
     */
    protected function getDates(Response $response)
    {
        return $this->getCrawler($response)->filter('.pop ul a')->each(function ($node) {
            /** @var Crawler $node */
            return \DateTime::createFromFormat('YmdHis', substr($node->attr('href'), 5, 14));
        });
    }

    /**
     * Create the crawler from body given by response.
     *
     * @param Response $response
     *
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
