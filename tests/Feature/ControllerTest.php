<?php

namespace ByThePixel\WeatherChallenge\Test;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * @see \ByThePixel\WeatherChallenge\Controller
 */
class ControllerTest extends TestCase
{

    use DatabaseTransactions;

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
