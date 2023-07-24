<?php

namespace ByThePixel\WeatherChallenge;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserWeatherUpdateEvent implements ShouldBroadcast
{
	use Dispatchable;
	use InteractsWithSockets;

	//use SerializesModels;

	public array $data;

	/**
	 * Create a new event instance.
	 */
	public function __construct(array $data)
	{
		//
		$this->data = $data;
	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return array<int, \Illuminate\Broadcasting\Channel>
	 */
	public function broadcastOn(): array
	{
		return [
			new PrivateChannel('local-weather-channel'),
		];
	}

    public function broadcastAs(): string
    {
        return 'lwe';
    }
}
