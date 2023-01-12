<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Listeners;

use OpenTelemetry\API\Metrics\ObserverInterface;
use Worksome\HorizonTelemetry\Enums\MeterName;
use Worksome\HorizonTelemetry\Enums\MeterUnit;
use Worksome\HorizonTelemetry\MeterProvider;

readonly class FailedJobsListener
{
    public function __construct(
        private MeterProvider $meterProvider,
    ) {
    }

    public function __invoke(): void
    {
        $meter = $this->meterProvider->getMeter(MeterName::FailedJobs);

        $meter->createObservableCounter(
            MeterName::FailedJobs->value,
            MeterUnit::Jobs->value,
            'The number of failed jobs.',
            fn (ObserverInterface $observer) => $observer->observe(1)
        );
    }
}
