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

### CurrentWorkloadMetric
The `CurrentWorkloadMetric` will register what the workload is in the different queues.  
This means you will have a histogram over the number of jobs in each queue.  
The metrics will be registered under the name `horizon_current_workload.<queue_name>`.

## Testing

```bash
composer test
```
