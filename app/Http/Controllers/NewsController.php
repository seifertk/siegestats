<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    const URL_BEG = 'https://prod-tridionservice.ubisoft.com/live/v1/News/Latest?templateId=tcm:152-76778-32';
    const IDX_STR = '&pageIndex=';
    const PER_STR = '&pageSize=';
    const URL_END = '&language=en-US&detailPageId=tcm:152-194572-64&keywordList=175426&siteId=undefined&useSeoFriendlyUrl=true&_=1508443064093';
    const PAGE_SIZE = 5;
    const CACHE_TIME = 15;
    const UBI_URL = 'https://rainbow6.ubisoft.com';
    const NEWS_REGEX = "(/siege/..-../news/)";
    const UPDATE_REGEX = "(/siege/..-../updates/)";

    public function getFeedUrl(int $page = 0, int $per_page = self::PAGE_SIZE)
    {
        // build the newsfeed URL
        return static::URL_BEG . static::IDX_STR . $page . static::PER_STR . $per_page . static::URL_END;
    }

    private function getUrl(string $url)
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_HEADER         => false,
            CURLOPT_FOLLOWLOCATION => true, 
            CURLOPT_ENCODING       => "",   
            CURLOPT_AUTOREFERER    => true, 
            CURLOPT_CONNECTTIMEOUT => 120,  
            CURLOPT_TIMEOUT        => 120,  
            CURLOPT_MAXREDIRS      => 10,   
        ];
        $curlHandle = curl_init($url);
        curl_setopt_array($curlHandle, $options);
        $content = curl_exec($curlHandle); 
        curl_close($curlHandle);

        return $content;
    }

    // Get the news feed as an array of JSON objects.
    // each object contains the content of the feed, which is HTML
    public function getFeedJson(int $page = 0, int $per_page = self::PAGE_SIZE)
    {
        $page = $this->getUrl($this->getFeedUrl($page, $per_page));

        $json = json_decode($page, true);

        if (array_key_exists('items', $json)) {
            return $json['items'];
        }

        return null;
    }

    // Get the HTML content of the news feed in an array
    public function getFeedContent(int $page = 0, int $per_page = self::PAGE_SIZE)
    {
        $content = $this->getFeedJson($page, $per_page);

        if (is_null($content)) {
            return [];
        }

        return array_map(function ($item) {
            if (array_key_exists('Content', $item)) {
                return $item['Content'];
            }
        }, $content);
    }

    // newsfeed anchors have relative links, this function will make them absolute
    private function mutateLinks(array $content, string $pattern)
    {
        return array_map(function ($item) use ($pattern) {
            return preg_replace("|$pattern|", self::UBI_URL . "\\1", $item);
        }, $content);
    }

    public function getUpdates()
    {
        // get the page and ignore bad chars
        libxml_use_internal_errors(true);
        $page = $this->getUrl(static::UBI_URL);
        
        // create a DOM and load into XML parser
        $dom = new \DomDocument;
        $dom->loadHTML($page);
        $selector = new \DomXPath($dom);

        // updates are a list item with the class 'r6_menu_patches'
        $list = $selector->query("//li[contains(@class,'r6_menu_patches')]");

        $items = [];

        for ($i = 0; $i < $list->length; ++$i) {
            $items[] = $dom->saveXml($list->item($i));
        }

        return $items;
    }

    public function getNews(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 0;
        $currentPage = max(intval($page), 0);

        // get the feed content from the cache if possible
        $content = Cache::remember("newsfeed_page_$currentPage", static::CACHE_TIME, function () use ($currentPage) {
            return $this->getFeedContent($currentPage);
        });

        $updates = Cache::remember("newsfeed_updates", static::CACHE_TIME, function () {
            return $this->getUpdates();
        });

        // change all the links to be absolute in the content, to point at Ubi
        $content = $this->mutateLinks($content, static::NEWS_REGEX);
        $updates = $this->mutateLinks($updates, static::UPDATE_REGEX);

        return view('news.index', compact('content', 'currentPage', 'updates'));
    }
}
