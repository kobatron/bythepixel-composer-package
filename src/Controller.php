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


        foreach(Cache::many($cache_keys) as $data){
            if(empty($data)){
                continue;
            }
            UserWeatherUpdateEvent::dispatch($data);
        }


		return response()
			->json(['success' => true, 'message' => 'Weather updates dispatched.']);
	}
}
