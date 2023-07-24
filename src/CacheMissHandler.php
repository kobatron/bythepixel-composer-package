<?php

namespace ByThePixel\WeatherChallenge;

use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CacheMissHandler
{
	/**
	 * Create the event listener.
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 */
	public function handle(CacheMissed $event): void
	{

		try{
			$user = User::findOrFailByCacheKey($event->key);
		}catch(\Exception $e){
			return;
		}

		Job::dispatch($user);
	}
}
