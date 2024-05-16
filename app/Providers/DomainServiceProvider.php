<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

use function class_exists;
use function dirname;
use function glob;
use function method_exists;
use function str_replace;

use const GLOB_NOSORT;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * The services provided by the provider.
     *
     * @var array<string>
     */
    private array $serviceProviders = [];

    /**
     * Create a new service provider instance.
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        foreach ($this->getAllServices() as $servicesProviderFQCN) {
            foreach ((array) $servicesProviderFQCN as $interface => $implementation) {
                $this->servicesProviders[$interface] = $implementation;
            }
        }
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->servicesProviders as $interface => $implementation) {
            $this->app->singleton($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }

    /**
     * Get all services.
     *
     * @return array<string>
     */
    private function getAllServices(): array
    {
        $rootDir = dirname(__DIR__, 2);
        $files   = glob($rootDir . '/src/Domain/*/ServiceProvider.php', GLOB_NOSORT);

        $services = [];
        foreach ($files as $file) {
            $className = str_replace([$rootDir . '/src/', '.php', '/'], ['Travle\\', '', '\\'], $file);
            if (! class_exists($className)) {
                continue;
            }

            $provider = new $className();
            if (! method_exists($provider, 'getServices')) {
                continue;
            }

            $services[] = $provider::getServices();
        }

        return $services;
    }
}
