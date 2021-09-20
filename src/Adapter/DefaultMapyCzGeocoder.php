<?php

declare(strict_types=1);

namespace Baraja\Geocoder;


final class DefaultMapyCzGeocoder implements GeocoderAdapter
{
	public function decode(string $address): Coordinates
	{
		$apiResponse = $this->downloadApiResponse($address);
		$xml = simplexml_load_string($apiResponse);
		if ($xml === false) {
			throw new \InvalidArgumentException('Empty mapy.cz response.');
		}
		$item = $xml->xpath('//item');
		if (isset($item[0]['x'], $item[0]['y'])) {
			return new Coordinates(
				latitude: (float) $item[0]['y'],
				longitude: (float) $item[0]['x'],
			);
		}

		throw new \InvalidArgumentException('Address can not be geocoded.');
	}


	private function downloadApiResponse(string $address): string
	{
		return (string) file_get_contents(
			'https://api4.mapy.cz/geocode?query=' . rawurlencode($address),
		);
	}
}
