<?php
namespace ByThePixel\WeatherChallenge;

interface Contract
{
	public function getLatitude(): float;
	public function getLongitude(): float;
	
	public function getCacheKeyAttribute(): string;
	public static function findOrFailByCacheKey(string $cache_key): static;
}