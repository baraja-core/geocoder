<?php

declare(strict_types=1);

namespace Baraja\Geocoder;


interface GeocoderAccessor
{
	public function get(): Geocoder;
}
