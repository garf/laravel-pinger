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


    /**
     * Create new instance of Pinger class
     */
    public function __construct() { }

    public function pingYandex($title, $url, $rss = null)
    {
        $client = new IXR_Client('http://ping.blogs.yandex.ru');
        $client->query('weblogUpdates.ping', [$title, $url]);
        dd($client->getResponse());
        $request = $this->_makeRequest($title, $url, $rss);

        $header[] = "Host: ping.blogs.yandex.ru";
        $header[] = "Content-type: text/xml";
        $header[] = "Content-length: " . strlen($request) . "\r\n";
        $header[] = $request;

        return $this->_sendPing($header, 'http://ping.blogs.yandex.ru');
    }

    public function pingGoogle($title, $url, $rss = null)
    {
        $request = $this->_makeRequest($title, $url, $rss);

        $header[] = "Host: ping.blogs.yandex.ru";
        $header[] = "Content-type: text/xml";
        $header[] = "Content-length: " . strlen($request) . "\r\n";
        $header[] = $request;

        return $this->_sendPing($header, 'http://ping.blogs.yandex.ru');
    }

    private function _makeRequest($title, $url, $rss = null)
    {
        if (empty($rss)) {
            return xmlrpc_encode_request("weblogUpdates.ping", array($title, $url));
        } else {
            //return xmlrpc_encode_request("weblogUpdates.ping", array($title, $url, $rss));
        }

    }

    private function _sendPing($header, $service)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $service);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
