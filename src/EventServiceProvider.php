<?php

namespace ByThePixel\WeatherChallenge;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseServiceProvider;

class EventServiceProvider extends BaseServiceProvider
{
	protected $listen = [
	];
	
	protected $subscribe = [
	];
	
	public function boot()
	{
		parent::boot();
	}
}
