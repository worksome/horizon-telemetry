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
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('horizon-telemetry')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_horizon-telemetry_table')
            ->hasCommand(HorizonTelemetryCommand::class);
    }
}
