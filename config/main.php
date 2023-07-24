<?php

return [
	'url'   => 'https://api.openweathermap.org/data/2.5/weather',
	'appid' => env('WEATHER_APPID'),

	'units' => ['c' => 'metric',
	            'f' => 'imperial',
	            'k' => 'standard',
	           ]['c'],

	'ttl'   => 59 /* *60 */,
	'locus' => [
		'weather.0.main'        => 'label',
		'weather.0.description' => 'description',
		'main.temp'             => 'temperature',
		'main.feels_like'       => 'feels_like',
	],
];
