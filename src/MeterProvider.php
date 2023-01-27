<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry;

use OpenTelemetry\API\Metrics\MeterInterface;
use OpenTelemetry\SDK\Metrics\MeterProviderInterface;
use Worksome\HorizonTelemetry\Enums\MeterName;

readonly class MeterProvider
{
    public function __construct(
        private MeterProviderInterface $meterProvider,
    ) {
    }

    public function getMeter(MeterName $meter): MeterInterface
    {
        return $this->meterProvider->getMeter(
            $meter->value
        );
    }

    public function flush(): void
    {
        $this->meterProvider->forceFlush();
    }
}
