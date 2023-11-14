<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Listeners;

use Illuminate\Queue\Events\JobProcessing;

/**
 * Needed for cleaning the peak memory usage variable inside PHP between jobs.
 */
readonly class ProcessedJobsPeakMemoryUsagePreparationListener
{
    public function __invoke(JobProcessing $event): void
    {
        memory_reset_peak_usage();
    }
}
