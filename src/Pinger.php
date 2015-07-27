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

    public function pingYandex($url, $title)
    {

    }

    private function sendPing($request, $url)
    {
        @file_get_contents();
    }
}
