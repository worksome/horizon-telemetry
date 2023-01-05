<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Worksome\HorizonTelemetry\Metrics\CurrentWorkloadMetric;

class HorizonTelemetryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->booted(function () {
            /** @var Schedule $schedule */
            $schedule = $this->app->make(Schedule::class);

            $schedule->call(CurrentWorkloadMetric::class)
                ->everyTenMinutes()
                ->name('CurrentWorkloadMetric');
        });
    }
}
