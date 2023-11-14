<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\ServiceProvider;
use Worksome\HorizonTelemetry\Enums\MeterName;
use Worksome\HorizonTelemetry\Listeners\FailedJobsListener;
use Worksome\HorizonTelemetry\Listeners\ProcessedJobsListener;
use Worksome\HorizonTelemetry\Listeners\ProcessedJobsPeakMemoryUsageListener;
use Worksome\HorizonTelemetry\Listeners\ProcessedJobsPeakMemoryUsagePreparationListener;
use Worksome\HorizonTelemetry\Metrics\CurrentJobsMetric;
use Worksome\HorizonTelemetry\Metrics\CurrentMasterSupervisorsMetric;
use Worksome\HorizonTelemetry\Metrics\CurrentProcessesMetric;

class HorizonTelemetryServiceProvider extends ServiceProvider
{
    private const CONFIG_PATH = __DIR__ . '/../config/telemetry.php';

    public function boot(): void
    {
        $this->callAfterResolving(Dispatcher::class, function (Dispatcher $dispatcher) {
            /** @var Repository $config */
            $config = $this->app->make(Repository::class);

            if (! $config->get('telemetry.enabled', true)) {
                return null;
            }

            if ($config->get($this->configKey(MeterName::FailedJobs), true)) {
                $dispatcher->listen(JobFailed::class, FailedJobsListener::class);
            }

            if ($config->get($this->configKey(MeterName::ProcessedJobs), true)) {
                $dispatcher->listen(JobProcessed::class, ProcessedJobsListener::class);
            }

            if ($config->get($this->configKey(MeterName::ProcessedJobsPeakMemoryUsage), true)) {
                $dispatcher->listen(JobProcessed::class, ProcessedJobsPeakMemoryUsageListener::class);
                $dispatcher->listen(JobProcessing::class, ProcessedJobsPeakMemoryUsagePreparationListener::class);
            }
        });

        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            /** @var Repository $config */
            $config = $this->app->make(Repository::class);

            if (! $config->get('telemetry.enabled', true)) {
                return null;
            }

            if ($currentMasterSupervisorsSchedule = $config->get(
                $this->configKey(MeterName::CurrentMasterSupervisors)
            )) {
                /** @var string $currentMasterSupervisorsSchedule */
                $schedule->call(CurrentMasterSupervisorsMetric::class)
                    ->cron($currentMasterSupervisorsSchedule)
                    ->name(MeterName::CurrentMasterSupervisors->value);
            }

            if ($currentProcessesSchedule = $config->get($this->configKey(MeterName::CurrentProcesses))) {
                /** @var string $currentProcessesSchedule */
                $schedule->call(CurrentProcessesMetric::class)
                    ->cron($currentProcessesSchedule)
                    ->name(MeterName::CurrentProcesses->value);
            }

            if ($currentJobsSchedule = $config->get($this->configKey(MeterName::CurrentJobs))) {
                /** @var string $currentJobsSchedule */
                $schedule->call(CurrentJobsMetric::class)
                    ->cron($currentJobsSchedule)
                    ->name(MeterName::CurrentJobs->value);
            }
        });
    }

    public function register(): void
    {
        $this->mergeConfigFrom(self::CONFIG_PATH, 'telemetry');
    }

    private function configKey(MeterName $meterName): string
    {
        return "telemetry.horizon.{$meterName->value}";
    }
}
