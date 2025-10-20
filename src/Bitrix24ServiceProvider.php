<?php

declare(strict_types=1);

namespace Codex\Bitrix24;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class Bitrix24ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/bitrix24.php', 'bitrix24');

        $this->app->singleton(Bitrix24Client::class, function (Container $app): Bitrix24Client {
            /** @var array<string, mixed> $config */
            $config = $app['config']->get('bitrix24', []);

            return new Bitrix24Client($config);
        });

        $this->app->singleton(Bitrix24Manager::class, function (Container $app): Bitrix24Manager {
            return new Bitrix24Manager($app->make(Bitrix24Client::class));
        });

        $this->app->alias(Bitrix24Manager::class, 'bitrix24');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/bitrix24.php' => $this->app->configPath('bitrix24.php'),
        ], 'bitrix24-config');
    }
}
