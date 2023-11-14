<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Listeners;

use Illuminate\Queue\Events\JobProcessed;
use Worksome\HorizonTelemetry\Enums\MeterName;
use Worksome\HorizonTelemetry\Enums\MeterUnit;
use Worksome\HorizonTelemetry\MeterProvider;

readonly class ProcessedJobsPeakMemoryUsageListener
{
    public function __construct(
        private MeterProvider $meterProvider,
    ) {
    }

    public function __invoke(JobProcessed $event): void
    {
        $meter = $this->meterProvider->getMeter(MeterName::ProcessedJobsPeakMemoryUsage);

        $histogram = $meter->createHistogram(
            MeterName::ProcessedJobsPeakMemoryUsage->value,
            MeterUnit::Bytes->value,
            'The memory usage per job',
        );


        $histogram->record(
            memory_get_peak_usage(),
            [
                'name' => $event->job->resolveName(),
                'queue' => $event->job->getQueue(),
            ]
        );

        $this->meterProvider->flush();
    }
}
