<?php

namespace src\oop\app\src\Parsers;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{
    public function parseContent(string $siteContent)
    {
        $crawler = new \Symfony\Component\DomCrawler\Crawler($siteContent);

        $title = $crawler->filter('#dle-content > div > article > div.fpage > div.ftitle > h1')->text();
        $poster = $crawler->filter('#dle-content > div > article > div.fpage > div.fcols.clearfix > div.fposter > a')->attr('href');
        $description = $crawler->filter('#dle-content > div > article > div.fpage > div.fdesc.full-text.noselect.clearfix')->text();

        $arr = ['title' => $title, 'poster'=> $poster, 'description' => $description];
        
        return $arr;
    }
}
