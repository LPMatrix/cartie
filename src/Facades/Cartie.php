<?php

namespace Lpmatrix\Cartie\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lpmatrix\Cartie\Skeleton\SkeletonClass
 */
class Cartie extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cartie';
    }
}
