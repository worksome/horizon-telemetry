<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Listeners;

use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use OpenTelemetry\API\Metrics\ObserverInterface;
use Worksome\HorizonTelemetry\Enums\MeterName;
use Worksome\HorizonTelemetry\Enums\MeterUnit;
use Worksome\HorizonTelemetry\MeterProvider;

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
