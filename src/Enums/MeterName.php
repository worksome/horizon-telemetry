<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Enums;

enum MeterName: string
{
    case CurrentMasterSupervisors = 'horizon_current_master_supervisors';
    case CurrentProcesses = 'horizon_current_processes';
    case CurrentJobs = 'horizon_current_jobs';
    case FailedJobs = 'horizon_failed_jobs';
    case ProcessedJobs = 'horizon_processed_jobs';

    public function with(string ...$names): string
    {
        return implode('.', [$this->value, ...$names]);
    }
}
