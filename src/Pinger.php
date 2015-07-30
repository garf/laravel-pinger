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

    private $services = [
        'http://ping.blogs.yandex.ru',
        'http://blogsearch.google.com/ping/RPC2',
        'http://api.my.yahoo.com/RPC2',
        'http://blogsearch.google.com/ping/RPC2',
        'http://1470.net/api/ping',
        'http://api.feedster.com/ping',
        'http://api.moreover.com/RPC2',
        'http://api.moreover.com/ping',
        'http://api.my.yahoo.com/RPC2',
        'http://api.my.yahoo.com/rss/ping',
        'http://bblog.com/ping.php',
        'http://bitacoras.net/ping',
        'http://blog.goo.ne.jp/XMLRPC',
        'http://blogdb.jp/xmlrpc',
        'http://blogmatcher.com/u.php',
        'http://bulkfeeds.net/rpc',
        'http://coreblog.org/ping/',
        'http://mod-pubsub.org/kn_apps/blogchatt',
        'http://www.lasermemory.com/lsrpc/',
        'http://ping.amagle.com/',
        'http://ping.bitacoras.com',
        'http://ping.blo.gs/',
        'http://ping.bloggers.jp/rpc/',
        'http://ping.cocolog-nifty.com/xmlrpc',
        'http://ping.blogmura.jp/rpc/',
        'http://ping.exblog.jp/xmlrpc',
        'http://ping.feedburner.com',
        'http://ping.myblog.jp',
        'http://ping.rootblog.com/rpc.php',
        'http://ping.syndic8.com/xmlrpc.php',
        'http://ping.weblogalot.com/rpc.php',
        'http://ping.weblogs.se/',
        'http://pingoat.com/goat/RPC2',
        'http://rcs.datashed.net/RPC2/',
        'http://rpc.blogbuzzmachine.com/RPC2',
        'http://rpc.blogrolling.com/pinger/',
        'http://rpc.icerocket.com:10080/',
        'http://rpc.newsgator.com/',
        'http://rpc.pingomatic.com',
        'http://rpc.technorati.com/rpc/ping',
        'http://rpc.weblogs.com/RPC2',
        'http://topicexchange.com/RPC2',
        'http://trackback.bakeinu.jp/bakeping.php',
        'http://www.a2b.cc/setloc/bp.a2b',
        'http://www.bitacoles.net/ping.php',
        'http://www.blogdigger.com/RPC2',
        'http://www.blogoole.com/ping/',
        'http://www.blogoon.net/ping/',
        'http://www.blogpeople.net/servlet/weblogUpdates',
        'http://www.blogroots.com/tb_populi.blog?id=1',
        'http://www.blogshares.com/rpc.php',
        'http://www.blogsnow.com/ping',
        'http://www.blogstreet.com/xrbin/xmlrpc.cgi',
        'http://www.mod-pubsub.org/kn_apps/blogchatter/ping.php',
        'http://www.newsisfree.com/RPCCloud',
        'http://www.newsisfree.com/xmlrpctest.php',
        'http://www.popdex.com/addsite.php',
        'http://www.snipsnap.org/RPC2',
        'http://www.weblogues.com/RPC/',
        'http://xmlrpc.blogg.de',
        'http://xping.pubsub.com/ping/',
    ];

    /**
     * Create new instance of Pinger class
     */
    public function __construct() { }

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
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
