<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Worksome\HorizonTelemetry\Commands\HorizonTelemetryCommand;

class HorizonTelemetryServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('horizon-telemetry')
            ->hasConfigFile()
            ->hasCommand(HorizonTelemetryCommand::class);
    }
}
