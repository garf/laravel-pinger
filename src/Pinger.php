<?php

namespace Gaaarfild\LaravelPinger;

use Illuminate\Support\Traits\Macroable;

/**
 * Class Pinger
 * @package Gaaarfild\LaravelPinger
 */
class Pinger
{

    use Macroable;

    private $services;

    /**
     * Create new instance of Pinger class
     */
    public function __construct() {
        $this->services = config('pinger.services');
    }

    public function pingYandex($title, $url, $rss = null)
    {
        $xml = $this->_getXml($title, $url, $rss);

        return $this->_sendPing('http://ping.blogs.yandex.ru', $xml);
    }

    public function pingGoogle($title, $url, $rss = null)
    {
        $xml = $this->_getXml($title, $url, $rss);

        return $this->_sendPing('http://blogsearch.google.com/ping/RPC2', $xml);
    }

    public function pingYahoo($title, $url, $rss = null)
    {
        $xml = $this->_getXml($title, $url, $rss);

        return $this->_sendPing('http://api.my.yahoo.com/RPC2', $xml);
    }

    public function pingFeedburner($title, $url, $rss = null)
    {
        $xml = $this->_getXml($title, $url, $rss);

        return $this->_sendPing('http://ping.feedburner.com', $xml);
    }

    public function pingWeblogs($title, $url, $rss = null)
    {
        $xml = $this->_getXml($title, $url, $rss);

        return $this->_sendPing('http://ping.weblogs.se/', $xml);
    }

    public function ping($service_url, $title, $url, $rss = null)
    {
        $xml = $this->_getXml($title, $url, $rss);

        return $this->_sendPing($service_url, $xml);
    }

    public function pingAll($title, $url, $rss = null)
    {
        $xml = $this->_getXml($title, $url, $rss);

        foreach ($this->services as $service) {
            $this->_sendPing($service, $xml);
        }
        return true;
    }

    private function _getXml($title, $url, $rss = null)
    {
        $data = [
            'title' => $title,
            'url' => $url,
        ];
        if (!empty($rss)) {
            $data['rss'] = $rss;
        }
        return view('laravel-pinger::xml', $data)->render();
    }

    private function _sendPing($url, $post)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
