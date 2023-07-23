<?php

namespace ByThePixel\WeatherChallenge;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Log;


/**
 * Class Client
 * @package ByThePixel\WeatherChallenge
 *
 * @see \ByThePixel\WeatherChallenge\Test\ClientTest::test_Client
 */
class Client
{
	private array        $config;
	private GuzzleClient $guzzle;
	
	/**
	 * Client constructor.
	 *
	 * @throws \Exception
	 *
	 * @see \ByThePixel\WeatherChallenge\Test\ClientTest::WeatherChallenge_client_is_configured
	 */
	public function __construct()
	{
		$config = config(ServiceProvider::SHORT_NAME);
		
		if(empty($config['appid'])
			or empty($config['url'])
			or empty($config['units'])){
			throw new \Exception('WeatherChallenge requires configuration.');
		}
		
		$this->config = $config;
		
		list($base, $path) = self::baseAndPath($config['url']);
		
		
		$this->guzzle = new GuzzleClient(['base_uri' => $base]);
	}
	
	private static function baseAndPath(string $full_url)
	{
		$url_info = parse_url($full_url);
		$base_url = $url_info['scheme'] . '://' . $url_info['host'];
		
		return [$base_url, $url_info['path']];
	}
	
	/**
	 * @param float $lat
	 * @param float $lon
	 *
	 * @return array|null
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 *
	 * @see \ByThePixel\WeatherChallenge\Test\ClientTest::WeatherChallenge_client_gets_weather
	 */
	public function getWeather(float $lat, float $lon)
	{
		list($base, $path) = self::baseAndPath($this->config['url']);
		try{
			$response = $this->guzzle->get($path, [
				'query' => [
					'lat'   => $lat,
					'lon'   => $lon,
					'appid' => config(ServiceProvider::SHORT_NAME . '.appid'),
					'units' => config(ServiceProvider::SHORT_NAME . '.units'),
				],
			]);
		}catch(\Exception $e){
			Log::warning('WeatherChallenge: ' . $e->getMessage());
			return null;
		}
		
		return json_decode($response->getBody()->getContents(), true);
	}
	
}