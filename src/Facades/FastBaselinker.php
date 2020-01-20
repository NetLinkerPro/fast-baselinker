<?php

namespace NetLinker\FastBaselinker\Facades;

use Illuminate\Support\Facades\Facade;

class FastBaselinker extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'fast-baselinker';
    }
}
