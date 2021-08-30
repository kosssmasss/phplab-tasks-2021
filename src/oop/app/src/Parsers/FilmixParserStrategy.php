<?php

namespace src\oop\app\src\Parsers;

class FilmixParserStrategy implements ParserInterface
{
    public function parseContent(string $siteContent)
    {
        $siteContent = mb_convert_encoding($siteContent, "UTF-8", "windows-1251");

        $re = '/<h1 class="name" itemprop="name">([\w\s\d]+)<\/h1>/ui';
        preg_match($re, $siteContent, $matches, PREG_OFFSET_CAPTURE, 0);
        $title = $matches[0][0];

        $re = '/<img src="(https:.*\.jpg)" class="poster poster-tooltip" itemprop="image" alt=".*" title=".*" loading="lazy"\/>/ui';
        preg_match($re, $siteContent, $matches, PREG_OFFSET_CAPTURE, 0);
        $poster = $matches[1][0];

        $re = '/<div\ class="about"\ itemprop="description"><div\ class="full-story">(.+)<\/div>/ui';
        preg_match($re, $siteContent, $matches, PREG_OFFSET_CAPTURE, 0);
        $description = $matches[0][0];


        $arr = ['title' => $title, 'poster'=> $poster, 'description' => $description];
        return $arr;
    }
}