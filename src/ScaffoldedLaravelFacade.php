<?php

namespace Khantnyar\ScaffoldedLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Khantnyar\ScaffoldedLaravel\Skeleton\SkeletonClass
 */
class ScaffoldedLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'scaffolded-laravel';
    }
}
