<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Worksome\HorizonTelemetry\HorizonTelemetry
 */
class HorizonTelemetry extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'horizon-telemetry';
    }
}
