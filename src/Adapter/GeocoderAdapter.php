<?php

declare(strict_types=1);

namespace Baraja\Geocoder;


interface GeocoderAdapter
{
	public function decode(string $address): Coordinates;
}
