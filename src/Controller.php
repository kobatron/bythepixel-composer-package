<?php

namespace ByThePixel\WeatherChallenge;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
	/**
	 * @return \Illuminate\Http\JsonResponse
	 *
	 *
	 *
	 * @see \ByThePixel\WeatherChallenge\Test\ControllerTest
	 */
	public function __invoke()
	{
		$users      = User::all();
		$cache_keys = $users
			->pluck('cache_key')
			->toArray();
		
		if(!Cache::has($cache_keys)){
			foreach($users as $user){
				Job::dispatch($user)
				   ->afterResponse();
			}
		}else{
			foreach(Cache::many($cache_keys) as $data){
				UserWeatherUpdateEvent::dispatch($data);
			}
		}
		
		return response()
			->json(['success' => true, 'message' => 'Weather updates dispatched.']);
	}
}
