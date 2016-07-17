<?php

namespace Garf\LaravelPinger;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Html\FormBuilder
 */
class PingerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pinger';
    }
}
