<?php declare(strict_types=1);

namespace Porthorian\Utility\Country;

class Country
{
	public readonly string $global_code;
	public readonly string $global_name;
	public readonly string $region_code;
	public readonly string $region_name;
	public readonly string $continent;
	public readonly string $sub_region_code;
	public readonly string $sub_region_name;
	public readonly string $intermediate_region_code;
	public readonly string $intermediate_region_name;
	public readonly string $country_or_area;
	public readonly string $m49_code;
	public readonly string $alpha2;
	public readonly string $alpha3;
	public readonly string $least_developed_countries;
	public readonly string $land_locked_developing_countries;
	public readonly string $small_island_developing_states;

	public function __construct(
		string $global_code = '',
		string $global_name = '',
		string $region_code = '',
		string $region_name = '',
		string $continent = '',
		string $sub_region_code = '',
		string $sub_region_name = '',
		string $intermediate_region_code = '',
		string $intermediate_region_name = '',
		string $country_or_area = '',
		string $m49_code = '',
		string $alpha2 = '',
		string $alpha3 = '',
		string $least_developed_countries = '',
		string $land_locked_developing_countries = '',
		string $small_island_developing_states = '',
	)
	{
		$this->global_code = $global_code;
		$this->global_name = $global_name;
		$this->region_code = $region_code;
		$this->region_name = $region_name;
		$this->continent = $continent;
		$this->sub_region_code = $sub_region_code;
		$this->sub_region_name = $sub_region_name;
		$this->intermediate_region_code = $intermediate_region_code;
		$this->intermediate_region_name = $intermediate_region_name;
		$this->country_or_area = $country_or_area;
		$this->m49_code = $m49_code;
		$this->alpha2 = $alpha2;
		$this->alpha3 = $alpha3;
		$this->least_developed_countries = $least_developed_countries;
		$this->land_locked_developing_countries = $land_locked_developing_countries;
		$this->small_island_developing_states = $small_island_developing_states;
	}

	public function getGlobalCode() : string
	{
		return $this->global_code;
	}

	public function getGlobalName() : string
	{
		return $this->global_name;
	}

	public function getRegionCode() : string
	{
		return $this->region_code;
	}

	public function getRegionName() : string
	{
		return $this->region_name;
	}

	public function getContinent() : string
	{
		return $this->continent;
	}

	public function getSubRegionCode() : string
	{
		return $this->sub_region_code;
	}

	public function getSubRegionName() : string
	{
		return $this->sub_region_name;
	}

	public function getIntermediateRegionCode() : string
	{
		return $this->intermediate_region_code;
	}

	public function getIntermediateRegionName() : string
	{
		return $this->intermediate_region_name;
	}

	public function getCountryOrArea() : string
	{
		return $this->country_or_area;
	}

	public function getM49Code() : string
	{
		return $this->m49_code;
	}

	public function getAlpha2() : string
	{
		return $this->alpha2;
	}

	public function getAlpha3() : string
	{
		return $this->alpha3;
	}

	public function isLeastDevelopedCountry() : bool
	{
		return $this->least_developed_countries === 'x';
	}

	public function isLandLockedDevelopingCountry() : bool
	{
		return $this->land_locked_developing_countries === 'x';
	}

	public function isSmallIslandDevelopingState() : bool
	{
		return $this->small_island_developing_states === 'x';
	}
}
