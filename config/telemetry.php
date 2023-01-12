<?php

declare(strict_types=1);

use Worksome\HorizonTelemetry\Enums\MeterName;

return [
    'horizon' => [
        /**
         * The crontab schedule for the number of current master supervisors.
         *
         * This can be either a crontab string, or `false` to disable the check.
         *
         * The default is 10 minutes, this can be any configured crontab, or set to `false` to disable this.
         */
        MeterName::CurrentMasterSupervisors->value => '*/10 * * * *',

        /**
         * The crontab schedule for the number of current processes in each queue
         *
         * This can be either a crontab string, or `false` to disable the check.
         *
         * The default is 10 minutes, this can be any configured crontab, or set to `false` to disable this.
         */
        MeterName::CurrentProcesses->value => '*/10 * * * *',

        /**
         * The crontab schedule for the number of current jobs in each queue.
         *
         * This can be either a crontab string, or `false` to disable the check.
         *
         * The default is 10 minutes, this can be any configured crontab, or set to `false` to disable this.
         */
        MeterName::CurrentWorkload->value => '*/10 * * * *',

        /**
         * Whether the failed job metric listener is enabled.
         *
         * The default is `true`, set to `false` to disable this.
         */
        MeterName::FailedJobs->value => true,
    ],
];
