<?php

namespace ByThePixel\WeatherChallenge;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

/**
 * Class Job
 * @package ByThePixel\WeatherChallenge
 *
 * @see \ByThePixel\WeatherChallenge\Test\JobTest
 */
class Job implements ShouldQueue
{
	use Dispatchable;
	use InteractsWithQueue;
	use Queueable;
	
	//use SerializesModels;
	/**
	 * @var \ByThePixel\WeatherChallenge\Contract
	 */
	private Contract $user;
	
	/**
	 * Create a new job instance.
	 *
	 */
	public function __construct(Contract $user)
	{
		//
		$this->user = $user;
	}
	
	/**
	 * Execute the job.
	 */
	public function handle(Client $client): void
	{
		//
		$response = $client->getWeather($this->user->getLatitude(), $this->user->getLongitude());
		$response = collect($response);
		if(!empty($response)){
			$locus = config(ServiceProvider::SHORT_NAME . '.locus');
			$ttl   = config(ServiceProvider::SHORT_NAME . '.ttl');
			$data = [];
			foreach ($locus as $key => $nice) {
				$value = data_get($response, $key);
				$data[$nice] = $value;
			}
			
			Cache::put($this->user->cache_key, $data, now()->addSecond($ttl));
			UserWeatherUpdateEvent::dispatch($data);
		}
	}
}
