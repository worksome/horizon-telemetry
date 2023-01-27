<?php

declare(strict_types=1);

use Worksome\HorizonTelemetry\Enums\MeterName;

return [
    'horizon' => [
        /**
         * The crontab schedule for the current number of master supervisors.
         *
         * This can be either a crontab string, or `false` to disable the check.
         *
         * The default is 10 minutes, this can be any configured crontab, or set to `false` to disable this.
         */
        MeterName::CurrentMasterSupervisors->value => '*/10 * * * *',

        /**
         * The crontab schedule for the current number of processes in each queue
         *
         * This can be either a crontab string, or `false` to disable the check.
         *
         * The default is 10 minutes, this can be any configured crontab, or set to `false` to disable this.
         */
        MeterName::CurrentProcesses->value => '*/10 * * * *',

        /**
         * The crontab schedule for the current number of jobs in each queue.
         *
         * This can be either a crontab string, or `false` to disable the check.
         *
         * The default is 10 minutes, this can be any configured crontab, or set to `false` to disable this.
         */
        MeterName::CurrentJobs->value => '*/10 * * * *',

        /**
         * Whether the failed job metric listener is enabled.
         *
         * The default is `true`, set to `false` to disable this.
         */
        MeterName::FailedJobs->value => true,

        /**
         * Whether the processed job metric listener is enabled.
         *
         * The default is `true`, set to `false` to disable this.
         */
        MeterName::ProcessedJobs->value => true,

        /**
         * Whether the processed job memory usage metric listener is enabled.
         *
         * The default is `true`, set to `false` to disable this.
         */
        MeterName::ProcessedJobsPeakMemoryUsage->value => true,
    ],
];
