<?php
/**
 * Create Class - Scrapper with method getMovie().
 * getMovie() - should return Movie Class object.
 *
 * Note: Use next namespace for Scrapper Class - "namespace src\oop\app\src;"
 * Note: Dont forget to create variables for TransportInterface and ParserInterface objects.
 * Note: Also you can add your methods if needed.
 */

namespace src\oop\app\src;

use src\oop\app\src\Models\Movie;

class Scrapper
{
    private $curlGuzzle;
    private $parserStrategy;

    public function __construct($curlGuzzle, $parserStrategy)
    {
        $this->curlGuzzle = $curlGuzzle;
        $this->parserStrategy = $parserStrategy;
    }

    public function getMovie($url): object
    {
        $content = $this->curlGuzzle->getContent($url);
        $parser = $this->parserStrategy->parseContent($content);

        $movie = new Movie();
        $movie->setTitle($parser['title']);
        $movie->setPoster($parser['poster']);
        $movie->setDescription($parser['description']);
        
        return $movie;
    }
}
