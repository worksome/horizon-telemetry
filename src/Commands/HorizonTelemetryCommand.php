<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Commands;

use Illuminate\Console\Command;

class HorizonTelemetryCommand extends Command
{
    public $signature = 'horizon-telemetry';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
