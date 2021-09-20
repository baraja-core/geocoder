<?php

declare(strict_types=1);

namespace Baraja\Geocoder;


use Nette\DI\CompilerExtension;

final class GeocoderExtension extends CompilerExtension
{
	public function beforeCompile(): void
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('geocoder'))
			->setFactory(Geocoder::class);

		$builder->addAccessorDefinition($this->prefix('geocoderAccessor'))
			->setImplement(GeocoderAccessor::class);
	}
}
