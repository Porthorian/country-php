<?php declare(strict_types=1);

namespace Porthorian\IsoCountry\Tests\Suite;

use PHPUnit\Framework\TestCase;
use Porthorian\IsoCountry\Countries;
use Porthorian\IsoCountry\CountryFactory;
use Porthorian\IsoCountry\CountryException;
use Porthorian\IsoCountry\Tests\DummyDriver;

class CountryFactoryTest extends TestCase
{
	public function testGetCountries()
	{
		$this->assertInstanceOf(Countries::class, (new CountryFactory(new DummyDriver()))->getCountries());
	}

	public function testNorthAmericaContinentCode()
	{
		$this->assertEquals('NA', CountryFactory::getIsoContinentCode('north america'));
		$this->assertEquals('NA', CountryFactory::getIsoContinentCode('North America'));
		$this->assertEquals('NA', CountryFactory::getIsoContinentCode('noRth ameRica'));
		$this->assertEquals('NA', CountryFactory::getIsoContinentCode('NORTH AMERICA'));
	}

	public function testSouthAmericaContinentCode()
	{
		$this->assertEquals('SA', CountryFactory::getIsoContinentCode('south america'));
		$this->assertEquals('SA', CountryFactory::getIsoContinentCode('South America'));
		$this->assertEquals('SA', CountryFactory::getIsoContinentCode('soUth ameRica'));
		$this->assertEquals('SA', CountryFactory::getIsoContinentCode('SOUTH AMERICA'));
	}

	public function testOceaniaContinentCode()
	{
		$this->assertEquals('OC', CountryFactory::getIsoContinentCode('oceania'));
		$this->assertEquals('OC', CountryFactory::getIsoContinentCode('Oceania'));
		$this->assertEquals('OC', CountryFactory::getIsoContinentCode('OCEANIA'));
		$this->assertEquals('OC', CountryFactory::getIsoContinentCode('OceaNiA'));
	}

	public function testAsiaContinentCode()
	{
		$this->assertEquals('AS', CountryFactory::getIsoContinentCode('asia'));
		$this->assertEquals('AS', CountryFactory::getIsoContinentCode('Asia'));
		$this->assertEquals('AS', CountryFactory::getIsoContinentCode('ASIA'));
		$this->assertEquals('AS', CountryFactory::getIsoContinentCode('aSiA'));
	}

	public function testAfricaContinentCode()
	{
		$this->assertEquals('AF', CountryFactory::getIsoContinentCode('africa'));
		$this->assertEquals('AF', CountryFactory::getIsoContinentCode('Africa'));
		$this->assertEquals('AF', CountryFactory::getIsoContinentCode('AFRICA'));
		$this->assertEquals('AF', CountryFactory::getIsoContinentCode('aFriCA'));
	}

	public function testEuropeContinentCode()
	{
		$this->assertEquals('EU', CountryFactory::getIsoContinentCode('europe'));
		$this->assertEquals('EU', CountryFactory::getIsoContinentCode('Europe'));
		$this->assertEquals('EU', CountryFactory::getIsoContinentCode('EUROPE'));
		$this->assertEquals('EU', CountryFactory::getIsoContinentCode('eUroPE'));
	}

	public function testAntarcticaContinentCode()
	{
		$this->assertEquals('AN', CountryFactory::getIsoContinentCode('antarctica'));
		$this->assertEquals('AN', CountryFactory::getIsoContinentCode('Antarctica'));
		$this->assertEquals('AN', CountryFactory::getIsoContinentCode('ANTARCTICA'));
		$this->assertEquals('AN', CountryFactory::getIsoContinentCode('antarCTiCA'));
	}

	public function testInvalidContinentCode()
	{
		$this->expectException(CountryException::class);
		$this->expectExceptionMessageMatches('/Invalid continent given unable to convert to continent code./');
		CountryFactory::getIsoContinentCode('insdfsdfsdfsdfasdFSADF');
	}
}
