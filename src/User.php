<?php

namespace ByThePixel\WeatherChallenge;

use Illuminate\Database\Eloquent\Model;

class User extends Model implements Contract
{
	
	private static $visable = [
		'name',
		'latitude',
		'longitude',
	];
	
	public function getLatitude(): float
	{
		return $this->latitude;
	}
	
	public function getLongitude(): float
	{
		return $this->longitude;
	}
	
	public function getCacheKeyAttribute(): string
	{
		return $this->table . ':' . $this->getKey();
	}
	
	public static function findOrFailByCacheKey(string $cache_key): static
	{
		$parts = explode(':', $cache_key);
		$id    = array_pop($parts);
		
		return self::findOrFail($id);
	}
	
	public function toArray()
	{
		$attributes = parent::toArray();
		$attributes = array_intersect_key($attributes, array_flip(self::$visable));
		
		return $attributes;
	}
}
