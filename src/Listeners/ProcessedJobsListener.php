<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Listeners;

use Illuminate\Queue\Events\JobProcessed;
use OpenTelemetry\API\Metrics\ObserverInterface;
use Worksome\HorizonTelemetry\Enums\MeterName;
use Worksome\HorizonTelemetry\Enums\MeterUnit;
use Worksome\HorizonTelemetry\MeterProvider;

readonly class ProcessedJobsListener
{
    public function __construct(
        private MeterProvider $meterProvider,
    ) {
    }

    public function __invoke(JobProcessed $event): void
    {
        $meter = $this->meterProvider->getMeter(MeterName::ProcessedJobs);

        $meter->createObservableUpDownCounter(
            MeterName::ProcessedJobs->value,
            MeterUnit::Jobs->value,
            'The number of processed jobs.',
            fn (ObserverInterface $observer) => $observer->observe(1, [
                'name' => $event->job->resolveName(),
                'queue' => $event->job->getQueue(),
            ])
        );

        $this->meterProvider->flush();
    }
}
