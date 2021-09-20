<?php

declare(strict_types=1);

namespace Baraja\Geocoder;


final class Geocoder
{
	/** @var GeocoderAdapter[] */
	private array $adapters = [];


	public function decode(Address|string $address): Coordinates
	{
		$addressString = (string) $address;
		$lastException = null;
		foreach ($this->getGeocoderAdapters() as $adapter) {
			try {
				return $adapter->decode($addressString);
			} catch (\Throwable $e) {
				$lastException = $e;
			}
		}

		throw new \LogicException(
			'Address "' . $addressString . '" can not be geocoded.',
			500,
			$lastException,
		);
	}


	/**
	 * @return GeocoderAdapter[]
	 */
	public function getGeocoderAdapters(): array
	{
		if ($this->adapters === []) {
			$this->adapters[] = new DefaultMapyCzGeocoder;
		}

		return $this->adapters;
	}


	public function addGeocoderAdapter(GeocoderAdapter $adapter): void
	{
		$this->adapters[] = $adapter;
	}
}
