<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry;

use OpenTelemetry\API\Metrics\MeterInterface;
use OpenTelemetry\API\Metrics\MeterProviderInterface;

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
}
