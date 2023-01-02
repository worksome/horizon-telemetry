<?php

namespace Worksome\HorizonTelemetry\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Worksome\HorizonTelemetry\HorizonTelemetryServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Worksome\\HorizonTelemetry\\Database\\Factories\\' . class_basename(
                $modelName
            ) . 'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            HorizonTelemetryServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_horizon-telemetry_table.php.stub';
        $migration->up();
        */
    }
}
