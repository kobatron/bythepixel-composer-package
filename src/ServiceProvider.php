<?php

namespace ByThePixel\WeatherChallenge;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider
 * @package ByThePixel\WeatherChallenge
 */
class ServiceProvider extends BaseServiceProvider{
	CONST VENDOR_PATH = 'by-the-pixel/weather-challenge';
	CONST SHORT_NAME = 'pixel-weather';

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot(){

		$this->bootConfig();
		$this->bootRoutes();

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register(){
		$this->app->singleton(Client::class, function ($app) {
			return new Client();
		});
	}


	/**
	 * @internal
	 */
	private function bootConfig(){
		$this->publishes([__DIR__ . '/../config/main.php' => config_path(self::SHORT_NAME . '.php')], 'config');
		$this->mergeConfigFrom(__DIR__ . '/../config/main.php', self::SHORT_NAME);
	}
	
	/**
	 * @internal
	 */
	private function bootRoutes()
	{
		$this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
	}
	
}