<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Metrics;

use Illuminate\Support\Collection;
use Laravel\Horizon\Contracts\MasterSupervisorRepository;
use OpenTelemetry\API\Metrics\ObserverInterface;
use Worksome\HorizonTelemetry\Enums\MeterName;
use Worksome\HorizonTelemetry\Enums\MeterUnit;
use Worksome\HorizonTelemetry\MeterProvider;

readonly class CurrentMasterSupervisorsMetric
{
    public function __construct(
        private MeterProvider $meterProvider,
        private MasterSupervisorRepository $masterSupervisorRepository,
    ) {
    }

    public function __invoke(): void
    {
        $meter = $this->meterProvider->getMeter(MeterName::CurrentMasterSupervisors);

        $masterSupervisors = Collection::make($this->masterSupervisorRepository->all());

        $meter->createObservableGauge(
            MeterName::CurrentMasterSupervisors->value,
            MeterUnit::MasterSupervisors->value,
            'The total number of master supervisors.',
            fn (ObserverInterface $observer) => $observer->observe($masterSupervisors->count())
        );
    }
}
