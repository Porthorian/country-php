<?php declare(strict_types=1);

namespace Porthorian\Utility\Country\Tests;

use PHPUnit\Framework\TestCase;
use Porthorian\Utility\Country\CountryException;
use Porthorian\Utility\Country\Countries;
use Porthorian\Utility\Country\Country;

class CountriesTest extends TestCase
{
	public function testGetByAlpha2()
	{
		$countries = new Countries();
		$country = $countries->getByAlpha2('gb');
		$this->assertNotNull($country);
		$this->assertInstanceOf(Country::class, $country);
		$this->assertNull($countries->getByAlpha2('gbsdsdsd'));
	}

	public function testGetByAlpha3()
	{
		$countries = new Countries();
		$country = $countries->getByAlpha3('gbr');
		$this->assertNotNull($country);
		$this->assertInstanceOf(Country::class, $country);
		$this->assertNull($countries->getByAlpha3('gbrassdd'));
	}

	public function testGetByM49Code()
	{
		$countries = new Countries();
		$country = $countries->getByM49Code('826');
		$this->assertNotNull($country);
		$this->assertInstanceOf(Country::class, $country);
		$this->assertNull($countries->getByM49Code('82625345345345'));
	}

	public function testGetByContinent()
	{
		$countries = new Countries();
		foreach (['North America', 'NA'] as $search)
		{
			$countries_inside = $countries->getByContinent($search);
			$this->assertNotNull($countries_inside);
			$this->assertIsArray($countries_inside);
			foreach ($countries_inside as $country)
			{
				$this->assertInstanceOf(Country::class, $country);
			}
		}

		$countries_inside = $countries->getByContinent('assd');
		$this->assertNull($countries_inside);
	}

	public function testFindAll()
	{
		$countries = new Countries();

		// Find all countries with "e" in them.
		$found_countries = $countries->findAll('country_or_area', 'e');
		$this->assertNotNull($found_countries);
		foreach ($found_countries as $country)
		{
			$this->assertInstanceOf(Country::class, $country);
			$this->assertStringContainsStringIgnoringCase('e', $country->getCountryOrArea());
		}

		$this->expectException(CountryException::class);
		$this->expectExceptionMessage('Invalid field name being searched.');
		$countries->findAll('asdasdsdfsdf', 'asdsd');
	}
}

