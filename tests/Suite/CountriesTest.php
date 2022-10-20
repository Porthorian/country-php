<?php declare(strict_types=1);

namespace Porthorian\IsoCountry\Tests\Suite;

use PHPUnit\Framework\TestCase;
use Porthorian\IsoCountry\CountryException;
use Porthorian\IsoCountry\Countries;
use Porthorian\IsoCountry\Country;
use Porthorian\IsoCountry\Tests\DummyDriver;

class CountriesTest extends TestCase
{
	public function testGetByAlpha2()
	{
		$countries = new Countries(new DummyDriver());
		$country = $countries->getByAlpha2('us');
		$this->assertNotNull($country);
		$this->assertInstanceOf(Country::class, $country);
		$this->assertNull($countries->getByAlpha2('gbsdsdsd'));
	}

	public function testGetByAlpha3()
	{
		$countries = new Countries(new DummyDriver());
		$country = $countries->getByAlpha3('usa');
		$this->assertNotNull($country);
		$this->assertInstanceOf(Country::class, $country);
		$this->assertNull($countries->getByAlpha3('gbrassdd'));
	}

	public function testGetByM49Code()
	{
		$countries = new Countries(new DummyDriver());
		$country = $countries->getByM49Code('840');
		$this->assertNotNull($country);
		$this->assertInstanceOf(Country::class, $country);
		$this->assertNull($countries->getByM49Code('82625345345345'));
	}

	public function testGetByContinent()
	{
		$countries = new Countries(new DummyDriver());
		foreach (['North America', 'NA'] as $search)
		{
			$countries_inside = $countries->getByContinent($search);
			$this->assertNotNull($countries_inside);
			$this->assertIsArray($countries_inside);
			$this->assertCount(1, $countries_inside);
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
		$countries = new Countries(new DummyDriver());

		// Find all countries with "f" in them.
		$found_countries = $countries->findAll('country_or_area', 'f');
		$this->assertNotNull($found_countries);
		$this->assertCount(1, $found_countries);
		foreach ($found_countries as $country)
		{
			$this->assertInstanceOf(Country::class, $country);
			$this->assertStringContainsStringIgnoringCase('e', $country->getCountryOrArea());
		}

		$this->expectException(CountryException::class);
		$this->expectExceptionMessage('Invalid field name being searched.');
		$countries->findAll('asdasdsdfsdf', 'asdsd');
	}

	public function testIterator()
	{
		$countries = new Countries(new DummyDriver());
		$this->assertCount(2, $countries);
		$iterator = 0;
		foreach ($countries as $key => $country)
		{
			$this->assertInstanceOf(Country::class, $country);
			$this->assertEquals($iterator++, $key);
		}
	}
}

