<?php

namespace src\oop\app\src\Transporters;

class CurlStrategy implements TransportInterface
{
    public function getContent(string $url): string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $body = curl_exec($ch);
        //var_dump(curl_getinfo($ch, CURLINFO_HEADER_OUT));
        curl_close($ch);
        
        return $body;
    }
}
