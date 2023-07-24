<?php

namespace ByThePixel\WeatherChallenge;

interface ModelContract
{
	public function getLatitude(): float;
	
	public function getLongitude(): float;
	
	public function getCacheKeyAttribute(): string;
	
	public static function findOrFailByCacheKey(string $cache_key): static;
}