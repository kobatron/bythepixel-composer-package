<?php

namespace ByThePixel\WeatherChallenge\Test;

use ByThePixel\WeatherChallenge\User;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

/**
 * @see \ByThePixel\WeatherChallenge\Controller
 */
class ControllerTest extends TestCase
{
	
	/**
	 * @see \ByThePixel\WeatherChallenge\Controller
	 * @test
	 */
	public function can_hit_api()
	{
		$response = $this->get('/api');
		$response->assertStatus(200);
	}
}
