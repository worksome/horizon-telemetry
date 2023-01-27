<?php

declare(strict_types=1);

namespace Worksome\HorizonTelemetry\Enums;

enum MeterUnit: string
{
    case MasterSupervisors = 'master supervisors';
    case Processes = 'processes';
    case Jobs = 'jobs';
    case Bytes = 'bytes';
}
