<?php

namespace ByThePixel\WeatherChallenge\Test;

use ByThePixel\WeatherChallenge\Client;
use ByThePixel\WeatherChallenge\Job;
use ByThePixel\WeatherChallenge\User;
use ByThePixel\WeatherChallenge\UserWeatherUpdateEvent;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

/**
 * @see \ByThePixel\WeatherChallenge\Job
 */
class JobTest extends TestCase
{
	use DatabaseTransactions;
	
	/**
	 * @see \ByThePixel\WeatherChallenge\Job::__construct
	 * @test
	 */
	public function can_fetch_weather_updates_for_users()
	{
		$user   = User::firstOrFail();
		$guzzel = App::make(Client::class);
		
		
		Event::fake(UserWeatherUpdateEvent::class);
		$job = new \ByThePixel\WeatherChallenge\Job($user);
		$job->handle($guzzel);
		Event::assertDispatched(UserWeatherUpdateEvent::class);
	}
	
	/**
	 * @test
	 */
	public function cat_dispatch_weather_job()
	{
		$user = User::firstOrFail();
		
		Queue::fake();
		Job::dispatch($user);
		Queue::assertPushed(Job::class);
	}
}
