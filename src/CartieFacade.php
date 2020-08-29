<?php

namespace Lpmatrix\Cartie;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lpmatrix\Cartie\Skeleton\SkeletonClass
 */
class CartieFacade extends Facade
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
