<?php

declare(strict_types=1);

namespace Baraja\Geocoder;


use Baraja\EcommerceStandard\DTO\CoordinatesInterface;

interface GeocoderAdapter
{
	public function decode(string $address): CoordinatesInterface;
}
