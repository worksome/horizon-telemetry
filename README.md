# OpenTelemetry for Laravel Horizon and queues

[![Latest Version on Packagist](https://img.shields.io/packagist/v/worksome/horizon-telemetry.svg?style=flat-square)](https://packagist.org/packages/worksome/horizon-telemetry)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/worksome/horizon-telemetry/tests.yml?branch=main&style=flat-square&label=Tests)](https://github.com/worksome/horizon-telemetry/actions?query=workflow%3ATests+branch%3Amain)
[![GitHub Static Analysis Action Status](https://img.shields.io/github/actions/workflow/status/worksome/horizon-telemetry/static.yml?branch=main&style=flat-square&label=Static%20Analysis)](https://github.com/worksome/horizon-telemetry/actions?query=workflow%3A"Static%20Analysis"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/worksome/horizon-telemetry.svg?style=flat-square)](https://packagist.org/packages/worksome/horizon-telemetry)

This package adds support for creating various matrices on your queues with the usage of Horizon.

This package requires that the scheduler is running, as it is adding new scheduled commands.

## Installation

You can install the package via composer:

```bash
composer require worksome/horizon-telemetry
```

## Usage

### Metrics

#### [`CurrentMasterSupervisorsMetric`](src/Metrics/CurrentMasterSupervisorsMetric.php)

The `CurrentMasterSupervisorsMetric` will register the current number of master supervisors.  
The metric will be registered under the name `horizon_current_master_supervisors`.

The default schedule for this is every 10 minutes (`*/10 * * * *`), to configure this,
add `MeterName::CurrentMasterSupervisors->value` under a `horizon` key in your `telemetry.php` config file.

#### [`CurrentProcessesMetric`](src/Metrics/CurrentProcessesMetric.php)

The `CurrentProcessesMetric` will register the current number of processes in each queue.  
The metrics will be registered under the name `horizon_current_processes.<queue_name>`.

The default schedule for this is every 10 minutes (`*/10 * * * *`), to configure this,
add `MeterName::CurrentProcesses->value` under a `horizon` key in your `telemetry.php` config file.

#### [`CurrentJobsMetric`](src/Metrics/CurrentJobsMetric.php)

The `CurrentJobsMetric` will register the current number of jobs in each queue.  
The metrics will be registered under the name `horizon_current_jobs.<queue_name>`.

The default schedule for this is every 10 minutes (`*/10 * * * *`), to configure this,
add `MeterName::CurrentJobs->value` under a `horizon` key in your `telemetry.php` config file.

### Event Listeners

#### [`FailedJobsListener`](src/Listeners/FailedJobsListener.php)

The `FailedJobsListener` listener will create an observable counter that will increment each time a job fails.
This metric will be registered under the name `horizon_failed_jobs`.

The default schedule for this is `true`, to disable this event listener,
add `MeterName::FailedJobs->value => false` under a `horizon` key in your `telemetry.php` config file.

#### [`ProcessedJobsListener`](src/Listeners/ProcessedJobsListener.php)

The `ProcessedJobsListener` listener will create an observable counter that will increment each time a job is processed.
This metric will be registered under the name `horizon_processed_jobs`.

The default schedule for this is `true`, to disable this event listener,
add `MeterName::ProcessedJobs->value => false` under a `horizon` key in your `telemetry.php` config file.


#### [`ProcessedJobsPeakMemoryUsageListener`](src/Listeners/ProcessedJobsPeakMemoryUsageListener.php)

The `ProcessedJobsPeakMemoryUsageListener` listener will create a histogram over peak memory usage each time a job is processed.
This metric will be registered under the name `horizon_processed_jobs_peak_memory_usage`.

Two listeners are actually registered here, the secondary listener is [`ProcessedJobsPeakMemoryUsagePreparationListener`](src/Listeners/ProcessedJobsPeakMemoryUsagePreparationListener.php)
which will take care of clearing the peak memory usage before a job starts, so for long-running queue workers, we get
the correct number.

The default schedule for this is `true`, to disable this event listener,
add `MeterName::ProcessedJobsPeakMemoryUsage->value => false` under a `horizon` key in your `telemetry.php` config file.


## Testing

```bash
composer test
```
