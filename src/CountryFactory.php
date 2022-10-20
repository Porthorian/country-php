<?php declare(strict_types=1);

namespace Porthorian\IsoCountry;

class CountryFactory
{
	private ?DatabaseDriverInterface $driver;

	public function __construct(?DatabaseDriverInterface $driver = null)
	{
		$this->driver = $driver;
	}

	public function getCountries() : Countries
	{
		return new Countries($this->driver);
	}

	public static function getIsoContinentCode(string $continent) : string
	{
		switch (strtolower(str_replace('_', ' ', $continent)))
		{
			case 'north america':
			return 'NA';

			case 'south america':
			return 'SA';

			case 'oceania':
			return 'OC';

			case 'asia':
			return 'AS';

			case 'africa':
			return 'AF';

			case 'europe':
			return 'EU';

			case 'antarctica':
			return 'AN';
		}

		throw new CountryException('Invalid continent given unable to convert to continent code. Continent: '.$continent);
	}
}
