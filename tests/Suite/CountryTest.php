<?php declare(strict_types=1);

namespace Porthorian\Utility\Country\Tests;

use PHPUnit\Framework\TestCase;
use Porthorian\Utility\Country\Country;
use Porthorian\Utility\String\StringUtility;

class CountryTest extends TestCase
{
	public function testInitialization()
	{
		$array = [
			'global_code'                      => '001',
			'global_name'                      => 'World',
			'region_code'                      => '019',
			'region_name'                      => 'Americas',
			'continent'                        => 'North America',
			'sub_region_code'                  => '021',
			'sub_region_name'                  => 'Northern America',
			'intermediate_region_code'         => '',
			'intermediate_region_name'         => '',
			'country_or_area'                  => 'United States of America',
			'm49_code'                         => '840',
			'alpha2'                           => 'US',
			'alpha3'                           => 'USA',
			'least_developed_countries'        => '',
			'land_locked_developing_countries' => '',
			'small_island_developing_states'   => '',
		];

		$country = new Country(...$array);
		foreach ($array as $key => $value)
		{
			$this->assertEquals($value, $country->$key, 'Key '.$key.' has failed equal assertion.');
			$function = 'get'.StringUtility::camelCase($key, '_', true);
			if (in_array($key, ['least_developed_countries', 'land_locked_developing_countries', 'small_island_developing_states']))
			{
				continue;
			}
			$this->assertEquals($value, $country->$function(), 'Function '.$function.' has failed equal assertion.');
		}

		$this->assertFalse($country->isLeastDevelopedCountry());
		$this->assertFalse($country->isLandLockedDevelopingCountry());
		$this->assertFalse($country->isSmallIslandDevelopingState());
		$this->assertEquals('NA', $country->getContinentCode());
	}
}
