<?php

namespace WebArchive;

use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Florent Denis <dflorent.pokap@gmail.com>
 */
class ResponseList extends BaseResponse
{
    /**
     * @return \DateTime[]
     */
    public function getDateArchives()
    {
        return $this->getDates('.day a');
    }

    /**
     * @return \DateTime[]
     */
    public function getDateSnapshots()
    {
        return $this->getDates('.pop ul a');
    }

    /**
     * @param $selector
     *
     * @return \DateTime[]
     */
    protected function getDates($selector)
    {
        return $this->getCrawler()->filter($selector)->each(function ($node, $i) {
            /** @var Crawler $node */
            return \DateTime::createFromFormat('YmdHis', substr($node->attr('href'), 5, 14));
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
