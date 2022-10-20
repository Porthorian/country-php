<?php declare(strict_types=1);

namespace Porthorian\Utility\Country\Tests;

use Porthorian\Utility\Country\DatabaseDriverInterface;

class DummyDriver implements DatabaseDriverInterface
{
	public function getAllContents() : array
	{
		return [
			[
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
				'small_island_developing_states'   => ''
			],
			[
				'global_code'                      => '001',
				'global_name'                      => 'World',
				'region_code'                      => '002',
				'region_name'                      => 'Africa',
				'continent'                        => 'Africa',
				'sub_region_code'                  => '015',
				'sub_region_name'                  => 'Northern Africa',
				'intermediate_region_code'         => '',
				'intermediate_region_name'         => '',
				'country_or_area'                  => 'Algeria',
				'm49_code'                         => '012',
				'alpha2'                           => 'DZ',
				'alpha3'                           => 'DZA',
				'least_developed_countries'        => '',
				'land_locked_developing_countries' => '',
				'small_island_developing_states'   => ''
			]
		];
	}
}
