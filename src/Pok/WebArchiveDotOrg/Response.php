<?php

namespace Pok\WebArchiveDotOrg;

use Zend\Http\Response as HttpResponse;

use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Florent Denis <dflorent.pokap@gmail.com>
 */
class Response
{
    /**
     * @var \Zend\Http\Response
     */
    protected $response;

    /**
     * @var
     */
    private $crawler;

    /**
     * Constructor.
     *
     * @param HttpResponse $response
     */
    public function __construct(HttpResponse $response)
    {
        $this->response = $response;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->response->isOk();
    }

    /**
     * @return \DateTime[]
     */
    public function getDateArchives()
    {
        return $this->getCrawler()->filter('.day a')->each(function ($node, $i) {
            /** @var \DomElement $node */

            return \DateTime::createFromFormat('YmdHis', substr($node->getAttribute('href'), 5, 14));
        });
    }

    /**
     * @return \DateTime[]
     */
    public function getDateSnapshots()
    {
        return $this->getCrawler()->filter('.pop ul a')->each(function ($node, $i) {
            /** @var \DomElement $node */

            return \DateTime::createFromFormat('YmdHis', substr($node->getAttribute('href'), 5, 14));
        });
    }

    /**
     * @return Crawler
     */
    protected function getCrawler()
    {
        if (null === $this->crawler) {
            $this->crawler = new Crawler();
            $this->crawler->addContent($this->response->getBody());

            $this->crawler = $this->crawler->filter('#wbCalendar .date');
        }

        return $this->crawler;
    }
}
