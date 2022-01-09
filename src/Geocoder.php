<?php

declare(strict_types=1);

namespace Baraja\Geocoder;


use Baraja\EcommerceStandard\DTO\AddressInterface;
use Baraja\EcommerceStandard\DTO\CoordinatesInterface;

final class Geocoder
{
	/** @var GeocoderAdapter[] */
	private array $adapters = [];


	public function decode(AddressInterface|string $address): CoordinatesInterface
	{
		if ($address instanceof AddressInterface) {
			$addressString = $this->serializeAddress($address);
		} else {
			$addressString = $address;
		}
		$lastException = null;
		foreach ($this->getGeocoderAdapters() as $adapter) {
			try {
				return $adapter->decode($addressString);
			} catch (\Throwable $e) {
				$lastException = $e;
			}
		}

		throw new \LogicException(
			sprintf('Address "%s" can not be geocoded.', $addressString),
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


	private function serializeAddress(AddressInterface $address): string
	{
		return (string) $address;
	}
}
