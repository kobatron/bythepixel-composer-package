<?php

namespace ByThePixel\WeatherChallenge\Test;

use Tests\TestCase;

/**
 * @see \ByThePixel\WeatherChallenge\Client
 */
class ClientTest extends TestCase 
{

	/**
	 * I name my tests so that they are readable in the test output,
	 * as opposed to CamelCase.  This is also nice to separate it
	 * from actual code when looking at logs, things like that.
	 *
	 * @see \ByThePixel\WeatherChallenge\Client
	 * @test
	 */
	public function WeatherChallenge_client_is_configured()
	{
		$client = new \ByThePixel\WeatherChallenge\Client();
		$this->assertInstanceOf(\ByThePixel\WeatherChallenge\Client::class, $client);
	}
	
	/**
	 * https://api.openweathermap.org/data/2.5/weather?lat=40.7128&lon=74.006&appid=YOUR_API_KEY
	 *
	 * @see \ByThePixel\WeatherChallenge\Client
	 * @test
	 */
	public function WeatherChallenge_client_gets_weather(){
		$client = new \ByThePixel\WeatherChallenge\Client();
		$weather = $client->getWeather(40.7128, 74.0060);
		$this->assertIsArray($weather);
		$this->assertArrayHasKey('main', $weather);
		$this->assertArrayHasKey('coord', $weather);
		$this->assertArrayHasKey('coord', $weather);
	}
}
