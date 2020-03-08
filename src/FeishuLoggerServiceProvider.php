<?php

namespace Logger;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

/**
 * Class FeishuLoggerServiceProvider
 * @package Logger
 */
class FeishuLoggerServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     */
    public function register()
    {
        $path = __DIR__ . '/config/feishu-logger.php';
        $this->mergeConfigFrom($path, 'feishu-logger');
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $path = __DIR__ . '/config/feishu-logger.php';
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$path => config_path('feishu-logger.php')], 'feishu-logger.php');
        } else if ($this->app instanceof LumenApplication) {
            $this->app->configure('feishu-logger');
        }
        $this->mergeConfigFrom($path, 'feishu-logger');
    }
}