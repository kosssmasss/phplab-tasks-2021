<?php

namespace src\oop\app\src\Transporters;

class GuzzleAdapter implements TransportInterface
{
    public function getContent(string $url): string
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $url);
        $body = $res->getBody();
        
        return $body;
    }
}
