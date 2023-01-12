<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\ServiceProvider;
use Worksome\HorizonTelemetry\Enums\MeterName;
use Worksome\HorizonTelemetry\Listeners\FailedJobsListener;
use Worksome\HorizonTelemetry\Metrics\CurrentMasterSupervisorsMetric;
use Worksome\HorizonTelemetry\Metrics\CurrentProcessesMetric;
use Worksome\HorizonTelemetry\Metrics\CurrentWorkloadMetric;

class HorizonTelemetryServiceProvider extends ServiceProvider
{
    private const CONFIG_PATH = __DIR__ . '/../config/telemetry.php';

    private const CONFIG_PREFIX = 'telemetry.horizon.';

    public function boot(Dispatcher $dispatcher, Repository $config): void
    {
        if ($config->get(self::CONFIG_PREFIX . MeterName::FailedJobs->value)) {
            $dispatcher->listen(JobFailed::class, FailedJobsListener::class);
        }

        $this->app->booted(function () {
            /** @var Schedule $schedule */
            $schedule = $this->app->make(Schedule::class);
            /** @var Repository $schedule */
            $config = $this->app->make(Repository::class);

            if ($currentMasterSupervisorsSchedule = $config->get(
                self::CONFIG_PREFIX . MeterName::CurrentMasterSupervisors->value
            )) {
                $schedule->call(CurrentMasterSupervisorsMetric::class)
                    ->cron($currentMasterSupervisorsSchedule)
                    ->name(MeterName::CurrentMasterSupervisors->value);
            }

            if ($currentProcessesSchedule = $config->get(self::CONFIG_PREFIX . MeterName::CurrentProcesses->value)) {
                $schedule->call(CurrentProcessesMetric::class)
                    ->cron($currentProcessesSchedule)
                    ->name(MeterName::CurrentProcesses->value);
            }

            if ($currentWorkloadSchedule = $config->get(self::CONFIG_PREFIX . MeterName::CurrentWorkload->value)) {
                $schedule->call(CurrentWorkloadMetric::class)
                    ->cron($currentWorkloadSchedule)
                    ->name(MeterName::CurrentWorkload->value);
            }
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(self::CONFIG_PATH, 'telemetry');
    }
}
