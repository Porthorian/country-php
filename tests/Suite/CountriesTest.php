<?php declare(strict_types=1);

namespace Porthorian\Utility\Country\Tests;

use PHPUnit\Framework\TestCase;
use Porthorian\Utility\Country\Countries;

class CountriesTest extends TestCase
{
	public function testGetByAlpha2()
	{
		$countries = new Countries();
		$this->assertNotNull($countries->getByAlpha2('gb'));
		$this->assertNull($countries->getByAlpha2('gbsdsdsd'));
	}

	public function testGetByAlpha3()
	{
		$countries = new Countries();
		$this->assertNotNull($countries->getByAlpha3('gbr'));
		$this->assertNull($countries->getByAlpha3('gbrassdd'));
	}

	public function testGetByM49Code()
	{
		$countries = new Countries();
		$this->assertNotNull($countries->getByM49Code('826'));
		$this->assertNull($countries->getByM49Code('82625345345345'));
	}
}

