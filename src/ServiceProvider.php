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

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register(){

	}


	/**
	 * @internal
	 */
	private function bootConfig(){
		$this->publishes([__DIR__ . '/../config/main.php' => config_path(SELF::SHORT_NAME . '.php')], 'config');
		$this->mergeConfigFrom(__DIR__ . '/../config/main.php', SELF::SHORT_NAME);
	}

}