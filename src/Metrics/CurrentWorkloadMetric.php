<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Metrics;

use Illuminate\Support\Collection;
use Laravel\Horizon\Contracts\WorkloadRepository;
use OpenTelemetry\API\Metrics\ObserverInterface;
use Worksome\HorizonTelemetry\Enums\MeterName;
use Worksome\HorizonTelemetry\Enums\MeterUnit;
use Worksome\HorizonTelemetry\MeterProvider;

readonly class CurrentWorkloadMetric
{
    public function __construct(
        private MeterProvider $meterProvider,
        private WorkloadRepository $workloadRepository,
    ) {
    }

    public function __invoke(): void
    {
        $meter = $this->meterProvider->getMeter(MeterName::CurrentWorkload);

        Collection::make($this->workloadRepository->get())
            ->each(function (array $workload) use ($meter) {
                /** @var array{name: string, length: integer, wait: double, processes: int, split_queues: array} $workload */

                $meter->createObservableGauge(
                    MeterName::CurrentWorkload->with($workload['name']),
                    MeterUnit::Jobs->value,
                    'The total number of jobs per queue.',
                    fn (ObserverInterface $observer) => $observer->observe($workload['length'])
                );
            });
    }
}
