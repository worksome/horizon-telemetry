<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Metrics;

use Illuminate\Support\Collection;
use Laravel\Horizon\Contracts\WorkloadRepository;
use Worksome\HorizonTelemetry\MeterName;
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

                $counter = $meter->createHistogram(
                    MeterName::CurrentWorkload->with($workload['name'])
                );

                $counter->record(
                    $workload['length'],
                    [
                        'length' => $workload['length'],
                        'wait' => $workload['wait'],
                        'processes' => $workload['processes'],
                    ],
                );
            });
    }
}
