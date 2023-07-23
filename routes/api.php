<?php

Route::match(['OPTIONS', 'GET'], '/api', [
	'middleware' => ['api'],
	'as'         => 'api',
	'uses'       => \ByThePixel\WeatherChallenge\Controller::class
]);