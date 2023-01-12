<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Enums;

enum MeterName: string
{
    case CurrentMasterSupervisors = 'horizon_current_master_supervisors';
    case CurrentProcesses = 'horizon_current_processes';
    case CurrentWorkload = 'horizon_current_workload';
    case FailedJobs = 'horizon_failed_jobs';

    public function with(string ...$names): string
    {
        return implode('.', [$this->value, ...$names]);
    }
}
