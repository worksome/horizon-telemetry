<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry;

enum MeterName: string
{
    case CurrentWorkload = 'horizon_current_workload';

    public function with(string ...$names): string
    {
        return implode('.', [$this->value, ...$names]);
    }
}
