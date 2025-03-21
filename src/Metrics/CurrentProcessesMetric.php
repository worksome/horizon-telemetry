<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Metrics;

use Illuminate\Support\Collection;
use Laravel\Horizon\Contracts\WorkloadRepository;
use OpenTelemetry\API\Metrics\ObserverInterface;
use Worksome\HorizonTelemetry\Enums\MeterName;
use Worksome\HorizonTelemetry\Enums\MeterUnit;
use Worksome\HorizonTelemetry\MeterProvider;

readonly class CurrentProcessesMetric
{
    public function __construct(
        private MeterProvider $meterProvider,
        private WorkloadRepository $workloadRepository,
    ) {
    }

    public function __invoke(): void
    {
        $meter = $this->meterProvider->getMeter(MeterName::CurrentProcesses);

        /** @var list<array{name: string, length: integer, wait: double, processes: int, split_queues: array}> $workloads */
        $workloads = $this->workloadRepository->get();

        Collection::make($workloads)
            ->each(function (array $workload) use ($meter) {
                $meter->createObservableGauge(
                    MeterName::CurrentProcesses->with($workload['name']),
                    MeterUnit::Processes->value,
                    'The total number of processes per queue.',
                    fn (ObserverInterface $observer) => $observer->observe($workload['processes'])
                );
            });
    }
}
